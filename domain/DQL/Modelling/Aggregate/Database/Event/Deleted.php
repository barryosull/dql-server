<?php namespace Domain\DQL\Modelling\Aggregate\Database\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id c44bb4b7-aef1-4c50-879d-badeea8ddc1d */
class Deleted extends AbstractEvent implements Event
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);
        $this->name = $name;
    }
}
