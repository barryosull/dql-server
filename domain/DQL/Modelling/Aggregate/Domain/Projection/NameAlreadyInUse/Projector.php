<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

/** @id bc34e480-779d-4156-92c7-631003a898e6 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_domain_created(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->domain_id, $event->name, $event->database_id);
    }
    
    protected function when_dql_modelling_domain_deleted(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->domain_id, $event->name);
    }
    
    protected function when_dql_modelling_domain_renamed(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->rename($event->domain_id, $event->new_name);
    }
}
