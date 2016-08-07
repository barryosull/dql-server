<?php namespace Infrastructure\Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements NameAlreadyInUse\Queryable
{
    protected $table = 'domain_modeling_schema_domain_name_already_in_use';
    
    public function name_already_in_use(Name $name, Uuid $database_id) 
    {
        $names = $this->query()
            ->where('name', $name->value())
            ->where('database_id', $database_id->value())
            ->count();

        return $names > 0;
    }
}
