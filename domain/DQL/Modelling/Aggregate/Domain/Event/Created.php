<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

class Created extends AbstractComposite implements \BoundedContext\Contracts\Event\DomainEvent
{
    public $database_id;
    public $name;

    public function __construct(Uuid $database_id, Name $name)
    {
        $this->database_id = $database_id;
        $this->name = $name;
    }
    
    public function database_id()
    {
        return $this->database_id;
    }
    
    public function name()
    {
        return $this->name;
    }
}
