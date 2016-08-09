<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Domain\DQL\Modelling\ValueObject\Name;

class Deleted extends AbstractComposite implements \BoundedContext\Contracts\Event\DomainEvent 
{
    public $name;

    public function __construct(Name $name)
    {
        $this->name = $name;
    }
    
    public function name()
    {
        return $this->name;
    }
}