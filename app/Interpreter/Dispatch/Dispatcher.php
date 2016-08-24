<?php namespace App\Interpreter\Dispatch;

use App\Interpreter\Handler;
use App\Interpreter\Aggregate;
use App\Interpreter\EventLog;
use App\Interpreter\CommandStore;
use App\Interpreter\RootEntityStore;

class Dispatcher
{
    private $handler;
    private $aggregate_root_builder;
    private $event_log;
    private $command_store;
    private $root_entity_store;
    private $root_entity;
    
    public function __construct( 
        Handler\Handler $handler,
        Aggregate\Aggregate $aggregate_root_builder,
        EventLog $event_log,
        CommandStore $command_store,
        RootEntityStore $root_entity_store
    )
    {
        $this->handler = $handler;
        $this->aggregate_root_builder = $aggregate_root_builder;
        $this->event_log = $event_log;
        $this->command_store = $command_store;
        $this->root_entity_store = $root_entity_store;
    }
        
    public function dispatch($command)
    {                
        $events = $this->handle_command($command);

        $this->event_log->store($events);
        $this->command_store->store([$command]);
        
        $aggregate_type = $command->schema->aggregate_id;
        $this->root_entity_store->store($aggregate_type, $this->root_entity);
        
        return $events;
    }
    
    private function handle_command($command)
    {
        $this->root_entity = $this->build_root_adapter($command);

        $events = $this->handle_command_adapter($command, $this->root_entity);
                
        return $this->decorate_events_with_command_id($events, $command);
    }
    
    private function build_root_adapter($command)
    {
        $aggregate_id = $command->schema->aggregate_id;
        $entity_id = $command->domain->aggregate_id;
        
        return $this->aggregate_root_builder->build_root($aggregate_id, $entity_id);
    }
    
    private function handle_command_adapter($command, $root_entity)
    {
        $command_ast_id = $command->schema->id;
        $payload = $command->domain->payload;
        
        return $this->handler->handle($command_ast_id, $root_entity, $payload);
    }
     
    private function decorate_events_with_command_id($events, $command)
    {
        return array_map(function($event) use ($command){
            $event->domain->command_id = $command->domain->id;
            return $event;
        }, $events);
    }
}