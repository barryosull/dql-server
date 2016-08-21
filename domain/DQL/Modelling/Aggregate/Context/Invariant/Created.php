<?php namespace Context\DQL\Modelling\Aggregate\Context\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Context\DQL\Modelling\Aggregate\Context\Projection as Queryable;

class Created extends AbstractInvariant implements Invariant
{
    protected function satisfier(Queryable $queryable)
    {   
        return $queryable->is_created();
    }
}
