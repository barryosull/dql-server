<?php namespace App\Projection\Database;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use Domain\DQL\Modelling\Aggregate\Database\Event;

/** @id 16fa1308-d1c8-4b92-b2a9-b39046be1af6 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_database_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($snapshot->root_entity_id(), $event->name);
    }
    
    protected function when_dql_modelling_database_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($snapshot->root_entity_id());
    }
    
    protected function when_dql_modelling_database_renamed(
        Projection $projection,
        Event\Renamed $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($snapshot->root_entity_id(), $event->new_name);
    }
}
