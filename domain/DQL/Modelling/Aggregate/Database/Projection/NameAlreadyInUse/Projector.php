<?php namespace Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

use Domain\DQL\Modelling\Aggregate\Database\Event;

/** @id 121837f2-6b4a-4450-855a-94bc23d2db49 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_database_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->name);
    }
    
    protected function when_dql_modelling_database_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->name);
    }
    
    protected function when_dql_modelling_database_renamed(
        Projection $projection,
        Event\Renamed $event,
        Snapshot $snapshot
    )
    {
        $projection->rename($event->old_name, $event->new_name);
    }
}
