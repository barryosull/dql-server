<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLParser;

use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Laravel\Bus;
use Domain\Modeling\Schema\ValueObject;
use Domain\Modeling\Schema\Aggregate\Database;
use BoundedContext\Laravel\Generator\Uuid;
use BoundedContext\Contracts\Business\Invariant;
use App\Projection\ID;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\BufferedOutput;

class ClientController extends Controller 
{
    private $modeling_dispatcher;
    private $command_log;
    private $database_queryable;
    
    public function __construct(
        Bus\Dispatcher $modeling_dispatcher,
        Log\Command $command_log,
        ID\Queryable $database_queryable
    )
    {
        $this->modeling_dispatcher = $modeling_dispatcher;
        $this->command_log = $command_log;
        $this->database_queryable = $database_queryable;
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
            $message = $this->preprocess_ast($ast);
            if ($message) {
                return Response::create($message, 200);
            }
            $command = $this->make_command_from_ast($ast);
            $this->modeling_dispatcher->dispatch($command);
            
            $command_id = $this->command_log->last_id();
            $message = "Command successful. Last command identifier '".$command_id->value()."'";
            
            return Response::create($message, 200);
        } catch (Invariant\Exception $ex) {
            return $this->make_error_from_ast_and_invariant_exception($ast, $ex);
        } catch (\Exception $e) {
            return Response::create($e->getMessage(), 400);
        }        
    }
    
    private function preprocess_ast($ast)
    {
        if ($ast->name == "UsingDatabase") {
            $name = new ValueObject\Name($ast->value);
            $id = $this->get_database_id($name);
            $current_database = session('UsingDatabase', ['id'=>'']);
            if ($current_database['id'] == $id->value()) {
                throw new \Exception("Already using database '".$ast->value."'");
            }
            session(['UsingDatabase' => ['name'=>$name->value(), 'id'=>$id->value()]]);
            return "Using database '".$name->value()."'.";
        }
        if ($ast->name == 'ShowDatabases') {
            $names = array_map(function(ValueObject\Name $name){
                return ["'".$name->value()."'"];
            }, $this->database_queryable->names());
            return $this->output_table(['Database'], $names);
        }
        return;
    }
    
    private function output_table($headers, $rows) 
    {
        $output = new BufferedOutput();
        $table = new Table($output);
        $table->setHeaders($headers)
            ->setRows($rows)
        ;
        $table->render();
        return substr($output->fetch(), 0, -1);
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
        return $this->database_queryable->id($name);
    }
}