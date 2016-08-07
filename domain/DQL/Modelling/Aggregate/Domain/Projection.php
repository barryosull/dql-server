<?php namespace Domain\DQL\Modelling\Aggregate\Domain;

use BoundedContext\Contracts\Projection\Projection as ProjectionContract;
use BoundedContext\Contracts\Projection\Queryable as QueryableContract;
use BoundedContext\Sourced\Aggregate\State\AbstractProjection;
use EventSourced\ValueObject\ValueObject\Boolean;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

class Projection extends AbstractProjection implements ProjectionContract, QueryableContract
{
    /** @var \EventSourced\ValueObject\ValueObject\Boolean */
    public $is_created;
    
    /** @var \Domain\DQL\Modelling\ValueObject\Name */
    public $name;
    
    /** @var EventSourced\ValueObject\ValueObject\Uuid */
    public $database_id;

    public function __construct()
    {
        $this->is_created = new Boolean(false);
    }

    public function create(Name $name, Uuid $database_id)
    {
        $this->name = $name;
        $this->is_created = new Boolean(true);
        $this->database_id = $database_id;
    }
        
    public function rename(Name $name)
    {
        $this->name = $name;
    }
}
