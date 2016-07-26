<?php namespace Infrastructure\Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;
use Domain\Modeling\Schema\ValueObject\Name;

class Projection extends AbstractProjection implements NameAlreadyInUse\Projection
{
    protected $table = 'domain_modeling_schema_database_name_already_in_use';

    /** @var Queryable $queryable */
    protected $queryable;
    
    public function create(Name $name) 
    {
        $this->query()->insert([
            'name' => $name->value()
        ]);
    }

    public function rename(Name $previous_name, Name $name)
    {
        $this->query()->delete([
            'name' => $previous_name->value()
        ]);
        
        $this->query()->insert([
            'name' => $name->value()
        ]);
    }

}
