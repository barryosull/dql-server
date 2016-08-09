<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Domain\DQL\Modelling\ValueObject\Name;

class Renamed extends AbstractComposite implements \BoundedContext\Contracts\Event\DomainEvent
{
    public $old_name;
    public $new_name;

    public function __construct(Name $old_name, Name $new_name)
    {
        $this->old_name = $old_name;
        $this->new_name = $new_name;
    }
    
    public function old_name()
    {
        return $this->old_name;
    }
    
    public function new_name()
    {
        return $this->new_name;
    }
}
