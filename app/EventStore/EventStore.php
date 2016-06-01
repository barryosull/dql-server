<?php namespace App\EventStore;

class EventStore
{
    private $event_repository;
    private $event_stream_factory;
    
    public function __construct(
        EventRepository $event_repository,
        EventStreamFactory $event_stream_factory)
    {
        $this->event_repository = $event_repository;
        $this->event_stream_factory = $event_stream_factory;
    }
    
    public function store(array $events)
    {
        $this->event_repository->store($events);
    }
    
    public function fetch(AggregateID $aggregate_id)
    {
        return $this->event_stream_factory->aggregate_id($aggregate_id);
    }
}