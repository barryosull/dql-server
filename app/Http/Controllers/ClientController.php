<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLParser;

use BoundedContext\Laravel\Bus;
use Domain\Modeling\Schema\ValueObject;
use Domain\Modeling\Schema\Aggregate\Database;
use BoundedContext\Laravel\Generator\Uuid;
use BoundedContext\Contracts\Business\Invariant;
use App\Projection\ID;

class ClientController extends Controller 
{
    private $modeling_dispatcher;
    private $id_queryable;
    
    public function __construct(
        Bus\Dispatcher $modeling_dispatcher,
        ID\Queryable $id_queryable
    )
    {
        $this->modeling_dispatcher = $modeling_dispatcher;
        $this->id_queryable = $id_queryable;
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
            return $this->make_error_from_ast_and_invariant_exception($ast, $ex);
        } catch (ID\Exception $e) {
            return Response::create($e->getMessage(), 400);
        }
        return $command->id()->value();
    }
    
    private function make_command_from_ast($ast)
    { 
        if ($ast->name == "CreateDatabase") {
            $id = (new Uuid())->generate();
            $name = new ValueObject\Name($ast->value);
            return new Database\Command\Create($id, $name);  
        }
        
        if ($ast->name == "DeleteDatabase") {
            $name = new ValueObject\Name($ast->value);
            $id = $this->get_database_id($name);
            return new Database\Command\Delete($id, $name);  
        }
        
        if ($ast->name == "RenameDatabase") {
            $old_name = new ValueObject\Name($ast->old);
            $id = $this->get_database_id($old_name);
            $new_name = new ValueObject\Name($ast->new);        
            return new Database\Command\Rename($id, $new_name);  
        } 
    }
    
    private function make_error_from_ast_and_invariant_exception($ast, $ex) 
    {
        $error_msg = $ex->getMessage();
        if (strpos($error_msg, "NameAlreadyInUse") !== false) {
            if ($ast->name == "CreateDatabase") {
                $error_msg = "The database '".$ast->value."' already exists.";
            }
            if ($ast->name == "RenameDatabase") {
                $error_msg = "The database '".$ast->new."' already exists.";
            } 
        }
        return Response::create($error_msg, 400);
    }
    
    private function get_database_id($name)
    {
        return $this->id_queryable->id($name);
    }
}