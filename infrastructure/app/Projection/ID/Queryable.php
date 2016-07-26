<?php namespace Infrastructure\App\Projection\ID;

use App\Projection\ID;
use Domain\Modeling\Schema\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements ID\Queryable
{
    protected $table = 'domain_modeling_schema_database_name_already_in_use';
    
    public function name_already_in_use(Name $name) 
    {
        $names = $this->query()
            ->where('name', $name->value())
            ->count();

        return $names > 0;
    }

    public function id(Name $name)
    {
        $row = $this->query()->where('name', $name->value())->first();
        return new Uuid($row->id);
    }
}
