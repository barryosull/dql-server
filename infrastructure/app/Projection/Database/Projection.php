<?php namespace Infrastructure\App\Projection\Database;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use App\Projection\Database;
use Domain\DQL\Modelling\ValueObject\Name;

class Projection extends AbstractProjection implements Database\Projection
{
    protected $table = 'app_modeling_name_to_id';

    /** @var Queryable $queryable */
    protected $queryable;

    public function set_name(\EventSourced\ValueObject\ValueObject\Uuid $id, Name $name)
    {
        $this->delete($id);
        
        $this->query()->insert([
            'id' => $id->value(),
            'name' => $name->value()
        ]);
    }

    public function delete(\EventSourced\ValueObject\ValueObject\Uuid $id)
    {
        $this->query()->where('id', '=', $id->value())->delete();
    }
}