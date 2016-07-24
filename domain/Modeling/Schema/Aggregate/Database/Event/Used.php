<?php namespace Domain\Modeling\Schema\Aggregate\Database\Event;

use BoundedContext\Contracts\Event\Event;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

/** @id a55e6792-1136-4f79-b6dd-021238e9b615 */
class Used extends AbstractEvent implements Event
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
