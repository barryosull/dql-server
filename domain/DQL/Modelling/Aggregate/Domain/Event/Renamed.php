<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 111e1c73-6eba-4e29-a109-02e22675954f */
class Renamed extends AbstractEvent implements Event
{
    public $old_name;
    public $new_name;

    public function __construct(Uuid $id, name $old_name, Name $new_name)
    {
        parent::__construct($id);
        $this->old_name = $old_name;
        $this->new_name = $new_name;
    }
}
