<?php namespace Infrastructure\Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

class Projection extends AbstractProjection implements NameAlreadyInUse\Projection
{
    protected $table = 'domain_modeling_schema_database_name_already_in_use';

    /** @var Queryable $queryable */
    protected $queryable;
    
    public function create(string $name) 
    {
        $this->query()->insert([
            'name' => $name
        ]);
    }

    public function rename(string $previous_name, string $name)
    {
        $this->delete($previous_name);
        
        $this->query()->insert([
            'name' => $name
        ]);
    }

    public function delete(string $name)
    {
        $this->query()->where([
            'name' => $name
        ])->delete();
    }
}
