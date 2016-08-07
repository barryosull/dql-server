<?php namespace Infrastructure\App\Projection\Domain;

use App\Projection\Domain;
use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements Domain\Queryable
{
    protected $table = 'app_domain_name_to_id';
    
    public function id(Uuid $database_id, Name $name)
    {
        $row = $this->query()
            ->where('name', $name->value())
            ->where('database_id', $database_id->value())
            ->first();
        if ($row) {
            return new Uuid($row->domain_id);
        }
        throw new Domain\Exception("There is no domain with the name '".$name->value()."'");
    }

    public function names(Uuid $database_id)
    {
        return array_map(function($row){
            return new Name($row->name);
        }, $this->query()->where('database_id', $database_id->value())->get());
    }

}
