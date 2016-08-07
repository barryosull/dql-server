<?php namespace Infrastructure\Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;
use Domain\DQL\Modelling\ValueObject\Name;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements NameAlreadyInUse\Queryable
{
    protected $table = 'app_modeling_name_to_id';
    
    public function name_already_in_use(Name $name) 
    {
        $names = $this->query()
            ->where('name', $name->value())
            ->count();

        return $names > 0;
    }
}
