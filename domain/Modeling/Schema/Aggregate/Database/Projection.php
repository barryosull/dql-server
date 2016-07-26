<?php namespace Domain\Modeling\Schema\Aggregate\Database;

use BoundedContext\Contracts\Projection\Projection as ProjectionContract;
use BoundedContext\Contracts\Projection\Queryable as QueryableContract;
use BoundedContext\Sourced\Aggregate\State\AbstractProjection;
use EventSourced\ValueObject\ValueObject\Boolean;
use Domain\Modeling\Schema\ValueObject\Name;

class Projection extends AbstractProjection implements ProjectionContract, QueryableContract
{
    /** @var \EventSourced\ValueObject\ValueObject\Boolean */
    public $is_created;
    
    /** @var \Domain\Modeling\Schema\ValueObject\Name */
    public $name;

    public function __construct()
    {
        $this->is_created = new Boolean(false);
    }

    public function create(Name $name)
    {
        $this->name = $name;
    }
    
    public function rename(Name $name)
    {
        $this->name = $name;
    }
}
