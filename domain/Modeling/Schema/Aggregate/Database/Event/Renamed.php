<?php namespace Domain\Modeling\Schema\Aggregate\Database\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\Modeling\Schema\ValueObject\Name;

/** @id 0f52c1f4-d914-4e09-b699-6f7af5e1fb89 */
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
