<?php namespace App\Interpreter\Query\Mongo;

use App;
use MongoDB\Client;
use App\Interpreter\Query\Property;

class Interpreter implements \App\Interpreter\Query\Interpreter
{
    private $db;
    private $ast;
    
    public function __construct($ast, Client $mongo_client)
    {
        $this->ast = $ast;
        $env = App::environment();
        $this->db = $mongo_client->$env;
    }
        
    public function query($root, $parameters)
    {
        $query = $this->make_query($this->ast, $root, $parameters);
        $aggregate_id = $this->ast->aggregate_id;
        $collection = $this->db->$aggregate_id;
        $cursor = $collection->aggregate($query);
        $rows = iterator_to_array($cursor);
        if (count($rows) != 0) {
            return $rows[0];
        }      
        
        return $this->get_default_values($this->ast->query->select);
    }
    
    private function make_query($ast, $root, $parameters)
    {
        return [
            ['$match'=>$this->make_match($ast->query->where, $root, $parameters)],
            ['$group'=>$this->make_group($ast->query->select)]
        ];
    }
    
    private function get_default_values($ast)
    {
        return (object)[
            $ast[0]->alias => 0
        ];
    }
    
    private function make_match($ast, $root, $parameters)
    {
        $wheres = [];
        foreach ($ast as $where_ast) {
            $value = $this->get_value($where_ast->value, $root, $parameters);
            $field = $where_ast->field;
            $comparator = $where_ast->comparator;
            $wheres[$field] = $this->make_comparator($comparator, $value);
        }
        return $wheres;
    }
    
    private function make_comparator($comparator, $value)
    {
        switch ($comparator) {
            case "=":
                return $value;
            case "!=":
                return ['$ne'=>$value];
            case ">":
                return ['$gt'=>$value];
            case "<":
                return ['$lt'=>$value];
        }
    }
    
    private function make_group($ast)
    {
        $field = $ast[0]->field;
        $alias = $ast[0]->alias;
        
        $reducer = $this->make_reducer($ast[0]);
        return [
            '_id' => $field,
            $alias => $reducer
        ];
    }
    
    private function make_reducer($ast)
    {
        switch ($ast->operation) {
            case "count":
                return ['$sum' => 1];
            case "sum":
                return ['$sum' => $ast->field];
        }
    }
    
    private function get_value($value_ast, $root, $parameters)
    {
        return (new Property\Interpreter($value_ast))->extract_value($root, $parameters);
    }
}