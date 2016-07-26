<?php namespace Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;

use Domain\Modeling\Schema\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(Name $name);
    
    public function rename(Name $previous_name, Name $name);
}
