<?php namespace App\Interpreter;

interface RootEntityStore
{    
    public function store($root_entity);
    
    public function run_query($query_ast);
}
