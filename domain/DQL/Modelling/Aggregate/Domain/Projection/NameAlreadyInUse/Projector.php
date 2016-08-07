<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

use Domain\DQL\Modelling\Aggregate\Domain\Event;

/** @id bc34e480-779d-4156-92c7-631003a898e6 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_domain_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->name, $event->database_id);
    }
    
    protected function when_dql_modelling_domain_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->name);
    }
    
    protected function when_dql_modelling_domain_renamed(
        Projection $projection,
        Event\Renamed $event,
        Snapshot $snapshot
    )
    {
        $projection->rename($event->old_name, $event->new_name);
    }
}
