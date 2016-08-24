<?php namespace App\Interpreter;

interface RootEntityStore
{    
    public function store($aggregate_type_id, $root_entity);
}
