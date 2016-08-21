<?php namespace Domain\DQL\Modelling\Aggregate\Database\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

class Created extends AbstractComposite implements \BoundedContext\Contracts\Event\DomainEvent
{
    public $database_id;
    public $name;

    public function __construct(Uuid $database_id, Name $name)
    {
        $this->database_id = $database_id;
        $this->name = $name;
    }
    
    public function name()
    {
        return $this->name;
    }
}
