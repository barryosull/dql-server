<?php namespace Domain\DQL\Modelling\Aggregate\Domain;

use BoundedContext\Contracts\Projection\Projection as ProjectionContract;
use BoundedContext\Contracts\Projection\Queryable as QueryableContract;
use BoundedContext\Sourced\Aggregate\State\AbstractProjection;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;
use Domain\DQL\Modelling\Entity\Domain;

class Projection extends AbstractProjection implements ProjectionContract, QueryableContract
{
    public function create(Uuid $id, Name $name, Uuid $database_id)
    {
        $this->root_entity = new Domain($id, $name, $database_id);
    }
        
    public function rename(Name $name)
    {
        $this->root_entity->name = $name;
    }
    
    public function is_created()
    {
        return ($this->root_entity);
    }
    
    public function name()
    {
        return $this->root_entity->name;
    }
}
