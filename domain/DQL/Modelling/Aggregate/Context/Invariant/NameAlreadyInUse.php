<?php namespace Context\DQL\Modelling\Aggregate\Context\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use EventSourced\ValueObject\ValueObject\Uuid;
use Context\DQL\Modelling\Aggregate\Context\Projection\NameAlreadyInUse\Queryable;
use Context\DQL\Modelling\ValueObject\Name;

class NameAlreadyInUse extends AbstractInvariant implements Invariant
{
    private $name;
    private $domain_id;
    
    protected function assumptions(Name $name, Uuid $domain_id)
    {
        $this->name = $name;
        $this->domain_id = $domain_id;
    }
    
    protected function satisfier(Queryable $queryable)
    {
        return $queryable->name_already_in_use($this->name, $this->domain_id);
    }
}
