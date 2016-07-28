<?php namespace Infrastructure\App\Projection\ID;

use App\Projection\ID;
use Domain\Modeling\Schema\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements ID\Queryable
{
    protected $table = 'app_modeling_name_to_id';
    
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
        if ($row) {
            return new Uuid($row->id);
        }
        throw new Exception("There is no database with the name '".$name->value()."'");
    }
}
