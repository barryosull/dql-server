<?php namespace Infrastructure\App\Projection\Domain;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use App\Projection\Domain;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

class Projection extends AbstractProjection implements Domain\Projection
{
    protected $table = 'app_domain_name_to_id';

    /** @var Queryable $queryable */
    protected $queryable;

    public function set_name(Uuid $id, Name $name, Uuid $database_id)
    {
        $this->delete($id);
        
        $this->query()->insert([
            'domain_id' => $id->value(),
            'name' => $name->value(),
            'database_id' => $database_id->value()
        ]);
    }

    public function delete(Uuid $id)
    {
        $this->query()->where('domain_id', '=', $id->value())->delete();
    }

    public function update_name(Uuid $domain_id, Name $name)
    {
        $this->query()->where('domain_id', '=', $domain_id->value())
            ->update(["name" => $name->value()]);
    }

}
