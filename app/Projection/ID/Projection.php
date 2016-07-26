<?php namespace App\Projection\ID;

use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\Modeling\Schema\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function set_name(Uuid $id, Name $name);
}
