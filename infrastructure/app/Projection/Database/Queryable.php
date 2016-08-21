<?php namespace Infrastructure\App\Projection\Database;

use App\Projection\Database;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements Database\Queryable
{
    protected $table = 'app_modeling_name_to_id';
    
    public function id(Name $name)
    {
        $row = $this->query()->where('name', $name->value())->first();
        if ($row) {
            return new Uuid($row->id);
        }
        throw new Database\Exception("The database name '".$name->value()."' does not exist.");
    }

    public function names()
    {
        return array_map(function($row){
            return new Name($row->name);
        }, $this->query()->get());
    }

}
