<?php namespace Infrastructure\App\Interpreter;

use App\EventLog\StreamID;

class EventLog implements \App\Interpreter\EventLog
{
    private $event_log;
    private $event_builder;
    
    public function __construct(
        \App\EventLog\EventLog $event_log,
         \App\EventLog\EventBuilder $event_builder
    )
    {
        $this->event_log = $event_log;
        $this->event_builder = $event_builder;
    }
    
    public function fetch($domain_aggregate_id, $schema_aggregate_id)
    {
        $stream_id = new StreamID($schema_aggregate_id, $domain_aggregate_id);
        
        return $this->event_log->fetch($stream_id);
    }

    public function store(array $events)
    {
        $transformed_events = array_map(function($event){
            $this->event_builder->set_aggregate_id($event->domain->aggregate_id)
                ->set_command_id($event->domain->command_id)
                ->set_schema_event_id($event->schema->id)
                ->set_schema_aggregate_id($event->schema->aggregate_id)
                ->set_payload($event->domain->payload);
            
            return $this->event_builder->build();
                    
        }, $events);
        
        $this->event_log->store($transformed_events);
    }
}
