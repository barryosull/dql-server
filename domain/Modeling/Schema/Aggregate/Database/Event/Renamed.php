<?php namespace Domain\Modeling\Schema\Aggregate\Database\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\Modeling\Schema\ValueObject\Name;

/** @id 0f52c1f4-d914-4e09-b699-6f7af5e1fb89 */
class Renamed extends AbstractEvent implements Event
{
    public $name;
    public $previous_name;

    public function __construct(Uuid $id, name $previous_name, Name $name)
    {
        parent::__construct($id);
        $this->previous_name = $previous_name;
        $this->name = $name;
    }
}
