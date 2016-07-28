<?php namespace Domain\Modeling\Schema\Aggregate\Database;

use BoundedContext\Sourced\Aggregate\State\AbstractState;

class State extends AbstractState implements \BoundedContext\Contracts\Sourced\Aggregate\State\State
{
    protected function when_modeling_schema_database_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->create($event->name);
    }
    
    protected function when_modeling_schema_database_renamed(
        Projection $projection,
        Event\Renamed $event
    )
    {
        $projection->rename($event->name);
    }
}
