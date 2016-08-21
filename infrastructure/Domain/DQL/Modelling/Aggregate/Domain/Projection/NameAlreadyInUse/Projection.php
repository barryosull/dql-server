<?php namespace Infrastructure\Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

class Projection extends AbstractProjection implements NameAlreadyInUse\Projection
{
    protected $table = 'domain_modeling_schema_domain_name_already_in_use';

    /** @var Queryable $queryable */
    protected $queryable;
    
    public function create($domain_id, $name, $database_id) 
    {
        $this->query()->insert([
            'domain_id' => $domain_id,
            'name' => $name,
            'database_id' => $database_id,
        ]);
    }

    public function rename($domain_id, $new_name)
    {
        $this->query()->where([
            'domain_id' => $domain_id
        ])->update([
            'name' => $new_name
        ]);
    }

    public function delete($domain_id)
    {
        $this->query()->where([
            'domain_id' => $domain_id
        ])->delete();
    }
}
