<?php namespace Domain\Modeling\Schema\Aggregate\Database\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Queryable;
use Domain\Modeling\Schema\ValueObject\Name;

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
