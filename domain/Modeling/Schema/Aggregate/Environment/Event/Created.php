<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\Modeling\Schema\ValueObject\Name;

/** @id cfd9ef79-2cf3-4ee6-805f-619f72352921 */
class Created extends AbstractEvent implements Event
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);
        $this->name = $name;
    }
}