<?php namespace App\Projection\Database;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

/** @id 16fa1308-d1c8-4b92-b2a9-b39046be1af6 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_database_created(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->database_id, $event->name);
    }
    
    protected function when_dql_modelling_database_deleted(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->database_id);
    }
    
    protected function when_dql_modelling_database_renamed(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->database_id, $event->new_name);
    }
}
