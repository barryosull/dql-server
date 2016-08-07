<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Event\AbstractEvent;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 439dc45e-26e1-432d-bb3d-ccbe0955eef1 */
class Created extends AbstractEvent implements Event
{
    public $database_id;
    public $name;
        
    public function __construct(Uuid $id, Uuid $database_id, Name $name)
    {
        parent::__construct($id);
        $this->database_id = $database_id;
        $this->name = $name;
    }
}
