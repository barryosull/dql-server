<?php namespace Context\DQL\Modelling\Aggregate\Context\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Context\DQL\Modelling\ValueObject\Name;

/** @id 058adb6f-2d08-47c0-aab7-b50025d28981 */
class Deleted extends AbstractComposite implements \BoundedContext\Contracts\Event\ContextEvent 
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