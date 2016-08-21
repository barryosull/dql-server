<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\DQL\Modelling\Aggregate\Domain\Projection as Queryable;

class Created extends AbstractInvariant implements Invariant
{
    protected function satisfier(Queryable $queryable)
    {   
        return $queryable->is_created();
    }
}
