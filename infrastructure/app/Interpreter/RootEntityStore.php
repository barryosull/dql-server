<?php namespace Infrastructure\App\Interpreter;

class RootEntityStore implements \App\Interpreter\RootEntityStore
{
    public function store($root_entity)
    {
        dd($root_entity);
    }

    public function run_query($query_ast)
    {
        
    }
}