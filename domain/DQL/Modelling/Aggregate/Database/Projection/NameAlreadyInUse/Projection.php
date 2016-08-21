<?php namespace Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(string $name);
    
    public function delete(string $name);
    
    public function rename(string $previous_name, string $name);
}
