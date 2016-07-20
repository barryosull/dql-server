<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Projection\NameAlreadyInUse;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

use Domain\Modeling\Schema\Aggregate\Environment\Event;

class Projector extends AbstractProjector
{
    protected function when_ddd_schema_environment_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->name);
    }
}
