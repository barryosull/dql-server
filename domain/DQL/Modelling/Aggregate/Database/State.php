<?php namespace Domain\DQL\Modelling\Aggregate\Database;

use BoundedContext\Sourced\Aggregate\State\AbstractState;

class State extends AbstractState implements \BoundedContext\Contracts\Sourced\Aggregate\State\State
{
    protected function when_dql_modelling_database_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->create($event->name);
    }
    
    protected function when_dql_modelling_database_renamed(
        Projection $projection,
        Event\Renamed $event
    )
    {
        $projection->rename($event->new_name);
    }
}
