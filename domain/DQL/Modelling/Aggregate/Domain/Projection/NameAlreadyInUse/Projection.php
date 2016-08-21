<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create($id, $name, $database_id);
    
    public function delete($id);
    
    public function rename($id, $new_name);
}
