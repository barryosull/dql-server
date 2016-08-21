<?php namespace App\Projection\Domain;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

/** @id 94bc23d3-6b4a-4156-855a-121837f2480a */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_domain_created(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->set_name($event->domain_id, $event->name, $event->database_id);
    }
        
    protected function when_dql_modelling_domain_renamed(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->update_name($event->domain_id, $event->new_name);
    }
    
        protected function when_dql_modelling_domain_deleted(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->domain_id);
    }
}
