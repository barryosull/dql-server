<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Event;

use BoundedContext\Contracts\Event\Event;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class Used extends AbstractEvent implements Event
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
