<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLParser;
use BoundedContext\Laravel\Bus;
use Domain\DQL\Modelling\ValueObject;
use Domain\DQL\Modelling\Aggregate\Database;
use Domain\DQL\Modelling\Aggregate\Domain;
use BoundedContext\Laravel\Generator\Uuid as UuidGenerator;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Contracts\Business\Invariant;
use App\Projection;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\BufferedOutput;

class ClientController extends Controller 
{
    private $modeling_dispatcher;
    private $database_queryable;
    private $domain_queryable;
    
    public function __construct(
        Bus\Dispatcher $modeling_dispatcher,
        Projection\Database\Queryable $database_queryable,
        Projection\Domain\Queryable $domain_queryable 
    )
    {
        $this->modeling_dispatcher = $modeling_dispatcher;
        $this->database_queryable = $database_queryable;
        $this->domain_queryable = $domain_queryable;
    }
    
    public function statement(
        Request $request, 
        DQLParser\DQLParser $parser
    ){
        $this->validate($request, ['statement' => 'required']);

        try {
            $ast = $parser->parse( $request->get('statement') );
        } catch (DQLParser\ParserError $e) {
            return Response::create($e->getMessage(), 400);
        }

        $result = "";
        if ($ast->type == "query") {
            $result = $this->handle_query($ast);
        }
        if ($ast->type == "controllerCommand") {
            $result = $this->handle_controller_command($ast);                
        }
        if ($ast->type == "command") {
            try {
                $result = $this->handle_command($ast);
            } catch (Invariant\Exception $ex) {
                return $this->domain_error_translation($ast, $ex);
            }
        }
        return Response::create($result, 200);
    }
    
    private function handle_query($ast)
    {
        if ($ast->name == 'ShowDatabases') {
            $names = array_map(function(ValueObject\Name $name){
                return ["'".$name->value()."'"];
            }, $this->database_queryable->names());
            if (count($names) == 0) {
                return "There are no databases.";
            }
            return $this->output_table(['Database'], $names);
        }
        if ($ast->name == 'ShowDomains') {
            $database_id = $this->get_using_database_id($ast);
            $names = array_map(function(ValueObject\Name $name){
                return ["'".$name->value()."'"];
            }, $this->domain_queryable->names($database_id));
            if (count($names) == 0) {
                return "There are no domains.";
            }
            return $this->output_table(['Domain'], $names);
        }
    }
    
    private function handle_controller_command($ast)
    {
        $name = new ValueObject\Name($ast->value);
        
        if ($ast->name == "UsingDatabase") {

            $id = $this->database_queryable->id($name);
            $current_database_id = $this->fetch_id('database');

            if ($current_database_id && $current_database_id->equals($id)) {
                throw new \Exception("Already using database '".$ast->value."'");
            }
            $this->store_id('database', $id);
            
            return "Using database '".$name->value()."'.";
        }
        
        if ($ast->name == "ForDomain") {
            $database_id = $this->get_using_database_id($ast);
            $id = $this->domain_queryable->id($database_id, $name);
            
            $current_domain_id = $this->fetch_id('domain');

            if ($current_domain_id && $current_domain_id->equals($id)) {
                throw new \Exception("Already using domain '".$ast->value."'");
            }
            $this->store_id('domain', $id);
            
            return "Using domain '".$name->value()."'.";
        }
    }
    
    private function handle_command($ast)
    {
        $command = $this->make_command_from_ast($ast);
        $this->modeling_dispatcher->dispatch($command);
        return "Command successful. Last command identifier '".$command->id()->value()."'";        
    }
    
    private function store_id($key, $id)
    {
        session([$key => $id]);
    }
    
    private function fetch_id($key)
    {
        $id = session($key, '');
        if ($id) {
            return new Uuid($id);
        }
        return null;
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
        $id = (new UuidGenerator())->generate();
        if ($ast->name == "CreateDatabase") {
            $entity_id = (new UuidGenerator())->generate();
            $name = $this->make_name($ast->value, 'database');
            return new Database\Command\Create($id, $entity_id, $name);  
        }
        
        if ($ast->name == "DeleteDatabase") {
            $name = $this->make_name($ast->value, 'database');
            $entity_id = $this->database_queryable->id($name);
            return new Database\Command\Delete($id, $entity_id, $name);  
        }
        
        if ($ast->name == "RenameDatabase") {
            $old_name = $this->make_name($ast->old, 'database');
            $entity_id = $this->database_queryable->id($old_name);
            $new_name = $this->make_name($ast->new, 'database');   
            return new Database\Command\Rename($id, $entity_id, $new_name);  
        } 
        
        $database_id = $this->get_using_database_id($ast);
        
        if ($ast->name == "CreateDomain") {
            $entity_id = (new UuidGenerator())->generate();
            $name = $this->make_name($ast->value, 'domain');
            return new Domain\Command\Create($id, $entity_id, $database_id, $name);
        } 
        
        if ($ast->name == "RenameDomain") {
            $old_name = $this->make_name($ast->old, 'domain');
            $entity_id = $this->domain_queryable->id($database_id, $old_name);
            $name = $this->make_name($ast->new, 'domain');
            return new Domain\Command\Rename($id, $entity_id, $name);
        } 
        
        if ($ast->name == "DeleteDomain") {
            $name = $this->make_name($ast->value, 'domain');
            $entity_id = $this->domain_queryable->id($database_id, $name);
            return new Domain\Command\Delete($id, $entity_id);
        } 
    }
    
    private function make_name($name, $type)
    {
        if ($name == '') {
            throw new \Exception("The $type name must not be blank.");
        }
        if (strlen($name) >= 128) {
            throw new \Exception("The $type name must be fewer than 128 characters.");
        }
        try {
            return new ValueObject\Name($name);
        } catch (\Exception $ex) {
            throw new \Exception("The $type name must contain a-z, 0-9, '.' and '-'.");
        }
    }
    
    private function get_using_database_id($ast)
    {
        if ($ast->using) {
            $name = $this->make_name($ast->using, 'database');
            $id = $this->database_queryable->id($name);
            return $id;
        }
        $selected_database_id = $this->fetch_key('database');
        if ($selected_database_id) {
            return $selected_database_id;
        }        
        throw new \Exception("No database selected");
    }
    
    
    private function domain_error_translation($ast, $ex) 
    {
        $error_msg = $ex->getMessage();
        if (strpos($error_msg, "NameAlreadyInUse") !== false) {
            if ($ast->name == "CreateDatabase") {
                $error_msg = "The database name '".$ast->value."' already exists.";
            }
            if ($ast->name == "RenameDatabase") {
                $error_msg = "The database name '".$ast->new."' already exists.";
            } 
            if ($ast->name == "CreateDomain") {
                $error_msg = "The domain name '".$ast->value."' already exists.";
            }
            if ($ast->name == "RenameDomain") {
                $error_msg = "The domain name '".$ast->value."' already exists.";
            }
            
        }
        return Response::create($error_msg, 400);
    }
}