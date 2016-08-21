<?php namespace Context\DQL\Modelling\Aggregate\Context\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Context\DQL\Modelling\ValueObject\Name;

/** @id e427e18f-16e5-4936-b07b-c33e8b6e6493 */
class Renamed extends AbstractComposite implements \BoundedContext\Contracts\Event\ContextEvent
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
