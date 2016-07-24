<?php namespace Domain\Modeling\Schema\Aggregate\Database\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Modeling\Schema\Aggregate\Database\Projection as Queryable;

class Created extends AbstractInvariant implements Invariant
{
    protected function satisfier(Queryable $queryable)
    {
        return $queryable->is_created->true();
    }
}
