<?php namespace Infrastructure\App\Interpreter;

use App;

class MongoDBRootEntityStore implements \App\Interpreter\RootEntityStore
{
    protected $db;
    
    public function __construct()
    {
        $env = App::environment();
        $this->db = (new \MongoDB\Client)->$env;
    }
    
    public function store($aggregate_type_id, $root_entity)
    {
        $collection = $this->db->$aggregate_type_id;
 
        $query = ['id'=>$root_entity->id];
        $collection->replaceOne($query, $root_entity, ['upsert'=> true]);
    }
    
    public function clear()
    {
        $this->db->drop();
    }
}