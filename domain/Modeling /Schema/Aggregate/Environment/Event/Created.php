<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Event;

use BoundedContext\Contracts\Event\Event;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;
use Domain\Modeling\Schema\ValueObject\Name;

class Created extends AbstractEvent implements Event
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);
        $this->name = $name;
    }
}
