<?php namespace Infrastructure\App\Projection\Domain;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use App\Projection\Domain;

class Projection extends AbstractProjection implements Domain\Projection
{
    protected $table = 'app_domain_name_to_id';

    /** @var Queryable $queryable */
    protected $queryable;

    public function set_name($id, $name, $database_id)
    {
        $this->delete($id);
        
        $this->query()->insert([
            'domain_id' => $id,
            'name' => $name,
            'database_id' => $database_id
        ]);
    }

    public function delete($id)
    {
        $this->query()->where('domain_id', '=', $id)->delete();
    }

    public function update_name($domain_id, $name)
    {
        $this->query()->where('domain_id', '=', $domain_id)
            ->update(["name" => $name]);
    }

}
