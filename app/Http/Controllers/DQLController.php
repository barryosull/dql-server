<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLServer;
use App\DQLParser;

use BoundedContext\Laravel\Bus;
use Domain\Modeling\Schema\ValueObject;
use Domain\Modeling\Schema\Aggregate\Environment;
use BoundedContext\Laravel\Generator\Uuid;

class DQLController extends Controller 
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

        try {
            $ast = $parser->parse($statement);
            $command = $this->make_command_from_ast($ast);
            $this->modeling_dispatcher->dispatch($command);
        } catch (DQLParser\ParserError $ex) {
            return Response::create($ex->getMessage(), 400);
        }
        return "Success";
    }
    
    private function make_command_from_ast($ast)
    {
        $id = (new Uuid())->generate();
        $name = new ValueObject\Name($ast->value);
        return new Environment\Command\Create($id, $name);  
    }
    
    public function command_dispatch(Request $request)
    {
        $command_id = $request->input('command_id');
        if (!$command_id) {
            return Response::create("Command ID cannot be empty.", 400);
        }
        
        $aggregate_id = $request->input('aggregate_id'); 
        if (!$aggregate_id) {
            return Response::create("Aggreggate ID cannot be empty.", 400);
        }
        
        $payload = json_decode($request->input('payload'));
        if (!$payload && $request->input('payload')) {
            return Response::create("Payload is not valid JSON.", 400);
        }
        $command = new DQLServer\Command($command_id, $aggregate_id, $payload);
        
        try {
            $result = $this->dql_server->dispatch($command);
        } catch (\App\Interpreter\Validation\ValueObject\PropertyException $ex) {
            return Response::create($ex->getMessage(), 400);
        }
        return json_encode($result);
    }
}