<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Queryable;
use Domain\DQL\Modelling\ValueObject\Name;

class NameAlreadyInUse extends AbstractInvariant implements Invariant
{
    private $name;
    private $database_id;
    
    protected function assumptions(Name $name, Uuid $database_id)
    {
        $this->name = $name;
        $this->database_id = $database_id;
    }
    
    protected function satisfier(Queryable $queryable)
    {
        return $queryable->name_already_in_use($this->name, $this->database_id);
    }
}
