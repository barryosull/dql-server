<?php namespace Test\Interpreter\Fake;

class EventLog implements \App\Interpreter\EventLog
{
    private static $events = [];
    
    public function fetch($domain_aggregate_id, $schema_aggregate_id)
    {
        return self::$events;
    }
    
    public function store(array $events)
    {
        foreach ($events as $event) {
            $event->schema->event_id = $event->schema->id;
            $event->payload = $event->domain->payload;
            self::$events[] = $event;
        }
    }
    
    public function clear()
    {
        self::$events = [];
    }
}
