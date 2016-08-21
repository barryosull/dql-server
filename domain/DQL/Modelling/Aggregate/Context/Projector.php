<?php namespace Context\DQL\Modelling\Aggregate\Context;

use BoundedContext\Sourced\Aggregate\State\AbstractState;

class Projector extends AbstractState implements \BoundedContext\Contracts\Sourced\Aggregate\State\State
{
    protected function when_dql_modelling_context_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->create($this->aggregate_id, $event->name, $event->database_id);
    }
    
    protected function when_dql_modelling_context_renamed(
        Projection $projection,
        Event\Renamed $event
    )
    {
        $projection->rename($event->new_name);
    }
}
