<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DQLServer;
use BoundedContext\Laravel\Bus;

class DQLController extends Controller 
{
    private $modeling_dispatcher;
    
    public function __construct(Bus\Dispatcher $modeling_dispatcher)
    {
        $this->modeling_dispatcher = $modeling_dispatcher;
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