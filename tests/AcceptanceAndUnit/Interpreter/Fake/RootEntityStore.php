<?php namespace Test\AcceptanceAndUnit\Interpreter\Fake;

class RootEntityStore implements \App\Interpreter\RootEntityStore
{
    private static $root_entity;
    
    public function store($aggregate_type_id, $root_entity)
    {
        self::$root_entity = $root_entity;
    }
    
    public function get_stored_test_entity()
    {
        return self::$root_entity;
    }

    public function run_query($query_ast)
    {
        
    }
}