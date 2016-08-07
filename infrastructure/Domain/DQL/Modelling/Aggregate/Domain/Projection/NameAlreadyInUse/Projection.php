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
    
    public function create(Uuid $domain_id, Name $name, Uuid $database_id) 
    {
        $this->query()->insert([
            'domain_id' => $domain_id->value(),
            'name' => $name->value(),
            'database_id' => $database_id->value(),
        ]);
    }

    public function rename(Uuid $domain_id, Name $new_name)
    {
        $this->query()->where([
            'domain_id' => $domain_id->value()
        ])->update([
            'name' => $new_name->value()
        ]);
    }

    public function delete(Uuid $domain_id)
    {
        $this->query()->where([
            'domain_id' => $domain_id->value()
        ])->delete();
    }
}
