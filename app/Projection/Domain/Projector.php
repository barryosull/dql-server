<?php namespace App\Projection\Domain;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use Domain\DQL\Modelling\Aggregate\Domain\Event;

/** @id 94bc23d3-6b4a-4156-855a-121837f2480a */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_domain_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->id(), $event->name, $event->database_id);
    }
        
    protected function when_dql_modelling_domain_renamed(
        Projection $projection,
        Event\Renamed $event,
        Snapshot $snapshot
    )
    {
        $projection->update_name($event->id(), $event->new_name);
    }
    
        protected function when_dql_modelling_domain_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->id());
    }
}
