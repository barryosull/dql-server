<?php namespace App\Projection\Domain;

use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function set_name(Uuid $id, Name $name, Uuid $database_id);
    
    public function update_name(Uuid $domain_id, Name $name);
    
    public function delete(Uuid $id);
}
