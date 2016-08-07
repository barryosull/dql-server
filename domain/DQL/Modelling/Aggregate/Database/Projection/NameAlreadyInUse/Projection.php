<?php namespace Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(Name $name);
    
    public function delete(Name $name);
    
    public function rename(Name $previous_name, Name $name);
}
