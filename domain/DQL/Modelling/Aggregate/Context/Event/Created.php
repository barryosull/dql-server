<?php namespace Context\DQL\Modelling\Aggregate\Context\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Context\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

/** @id b0c3db47-20c4-4ad3-8d1e-fcf72463e21c */
class Created extends AbstractComposite implements \BoundedContext\Contracts\Event\ContextEvent
{
    public $domain_id;
    public $name;

    public function __construct(Uuid $domain_id, Name $name)
    {
        $this->domain_id = $domain_id;
        $this->name = $name;
    }
    
    public function domain_id()
    {
        return $this->domain_id;
    }
    
    public function name()
    {
        return $this->name;
    }
}
