<?php namespace Domain\DQL\Modelling\Aggregate\Database\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Queryable;
use Domain\DQL\Modelling\ValueObject\Name;

class NameAlreadyInUse extends AbstractInvariant implements Invariant
{
    private $name;
    
    protected function assumptions(Name $name)
    {
        $this->name = $name;
    }
    
    protected function satisfier(Queryable $queryable)
    {
        return $queryable->name_already_in_use($this->name);
    }
}
