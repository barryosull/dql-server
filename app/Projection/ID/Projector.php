<?php namespace App\Projection\ID;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use Domain\Modeling\Schema\Aggregate\Database\Event;

/** @id 16fa1308-d1c8-4b92-b2a9-b39046be1af6 */
class Projector extends AbstractProjector
{
    protected function when_modeling_schema_database_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->id(), $event->name);
    }
    
    protected function when_modeling_schema_database_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->id());
    }
    
    protected function when_modeling_schema_database_renamed(
        Projection $projection,
        Event\Renamed $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->id(), $event->name);
    }
}
