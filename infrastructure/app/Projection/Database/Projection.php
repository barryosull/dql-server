<?php namespace Infrastructure\App\Projection\Database;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use App\Projection\Database;

class Projection extends AbstractProjection implements Database\Projection
{
    protected $table = 'app_modeling_name_to_id';

    /** @var Queryable $queryable */
    protected $queryable;

    public function set_name($id, $name)
    {
        $this->delete($id);
        
        $this->query()->insert([
            'id' => $id,
            'name' => $name
        ]);
    }

    public function delete($id)
    {
        $this->query()->where('id', '=', $id)->delete();
    }
}
