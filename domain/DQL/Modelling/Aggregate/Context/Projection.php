<?php namespace Context\DQL\Modelling\Aggregate\Context;

use BoundedContext\Contracts\Projection\Projection as ProjectionContract;
use BoundedContext\Contracts\Projection\Queryable as QueryableContract;
use BoundedContext\Sourced\Aggregate\State\AbstractProjection;
use EventSourced\ValueObject\ValueObject\Uuid;
use Context\DQL\Modelling\ValueObject\Name;
use Context\DQL\Modelling\Entity\Context;

class Projection extends AbstractProjection implements ProjectionContract, QueryableContract
{
    public function create(Uuid $id, Name $name, Uuid $domain_id)
    {
        $this->root_entity = new Context($id, $name, $domain_id);
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
