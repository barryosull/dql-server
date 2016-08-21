<?php namespace Context\DQL\Modelling\Aggregate\Context\Projection\NameAlreadyInUse;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

/** @id 098b7173-b252-46a3-91d0-c88e4d006d94 */
class Projector extends AbstractProjector
{
    protected function when_dql_modelling_context_created(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->context_id, $event->name, $event->domain_id);
    }
    
    protected function when_dql_modelling_context_deleted(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->delete($event->context_id, $event->name);
    }
    
    protected function when_dql_modelling_context_renamed(
        Projection $projection,
        $event,
        Snapshot $snapshot
    )
    {
        $projection->rename($event->context_id, $event->new_name);
    }
}
