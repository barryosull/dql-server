<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLParser;

use BoundedContext\Laravel\Bus;
use Domain\Modeling\Schema\ValueObject;
use Domain\Modeling\Schema\Aggregate\Database;
use BoundedContext\Laravel\Generator\Uuid;
use BoundedContext\Contracts\Business\Invariant;

class ClientController extends Controller 
{
    private $modeling_dispatcher;
    
    public function __construct(Bus\Dispatcher $modeling_dispatcher)
    {
        $this->modeling_dispatcher = $modeling_dispatcher;
    }
    
    public function command(
        Request $request, 
        DQLParser\DQLParser $parser
    ){
        $this->validate($request, [
            'statement' => 'required',
        ]);
        $statement = $request->get('statement');

        $ast;
        try {
            $ast = $parser->parse($statement);
            $command = $this->make_command_from_ast($ast);
            $this->modeling_dispatcher->dispatch($command);

        } catch (DQLParser\ParserError $ex) {
            return Response::create($ex->getMessage(), 400);
        } catch (Invariant\Exception $ex) {
            if (strpos($ex->getMessage(), "NameAlreadyInUse") !== false) {
                $name = $ast->value;
                $error_msg = "The database '$name' already exists.";
                return Response::create($error_msg, 400);
            }
            return Response::create($ex->getMessage(), 400);
        }
        return $command->id()->value();
    }
    
    private function make_command_from_ast($ast)
    { 
        $name = new ValueObject\Name($ast->value);
        if ($ast->name == "CreateDatabase") {
            $id = (new Uuid())->generate();
            return new Database\Command\Create($id, $name);  
        }
        
        if ($ast->name == "RenameDatabase") {
            $id = $this->get_database_id($name);
            return new Database\Command\Rename($id, $name);  
        } 
    }
    
    private function get_database_id(Name $name)
    {
        
    }
}