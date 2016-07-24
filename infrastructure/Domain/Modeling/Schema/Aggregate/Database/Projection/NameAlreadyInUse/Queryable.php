<?php namespace Infrastructure\Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;

use Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;
use Domain\Modeling\Schema\ValueObject\Name;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements NameAlreadyInUse\Queryable
{
    protected $table = 'domain_modeling_schema_database_name_already_in_use';
    
    public function name_already_in_use(Name $name) 
    {
        $names = $this->query()
            ->where('name', $name->value())
            ->count();

        return $names > 0;
    }
}
