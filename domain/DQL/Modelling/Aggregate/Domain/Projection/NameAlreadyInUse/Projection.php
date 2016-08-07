<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(Uuid $id, Name $name, Uuid $database_id);
    
    public function delete(Uuid $id);
    
    public function rename(Uuid $id, Name $new_name);
}
