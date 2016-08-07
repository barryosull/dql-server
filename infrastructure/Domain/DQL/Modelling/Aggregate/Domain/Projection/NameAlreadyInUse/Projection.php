<?php namespace Infrastructure\Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

class Projection extends AbstractProjection implements NameAlreadyInUse\Projection
{
    protected $table = 'domain_modeling_schema_domain_name_already_in_use';

    /** @var Queryable $queryable */
    protected $queryable;
    
    public function create(Name $name, Uuid $datasbase_id) 
    {
        $this->query()->insert([
            'name' => $name->value(),
            'database_id' => $datasbase_id->value(),
        ]);
    }

    public function rename(Name $previous_name, Name $name)
    {
        $this->delete($previous_name);
        
        $this->query()->insert([
            'name' => $name->value()
        ]);
    }

    public function delete(Name $name)
    {
        $this->query()->where([
            'name' => $name->value()
        ])->delete();
    }
}
