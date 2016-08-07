<?php namespace App\Projection\Database;

use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function set_name(Uuid $id, Name $name);
    
    public function delete(Uuid $name);
}
