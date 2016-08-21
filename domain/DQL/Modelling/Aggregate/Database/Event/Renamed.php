<?php namespace Domain\DQL\Modelling\Aggregate\Database\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

class Renamed extends AbstractComposite implements \BoundedContext\Contracts\Event\DomainEvent
{
    public $database_id;
    public $old_name;
    public $new_name;

    public function __construct(Uuid $database_id, Name $old_name, Name $new_name)
    {
        $this->database_id = $database_id;
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
