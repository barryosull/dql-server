<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(Name $name, Uuid $database_id);
    
    public function delete(Name $name);
    
    public function rename(Name $previous_name, Name $name);
}
