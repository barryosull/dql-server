<?php namespace App\Interpreter\Event;

use App\Interpreter\Validation;

class Interpreter
{
    private $event_id;
    private $aggregate_id;
    private $validator;
    private $children;
    
    public function __construct($event_id, $aggregate_id, Validation\Validator $validator, $children)
    {
        $this->event_id = $event_id;
        $this->aggregate_id = $aggregate_id;
        
        $this->validator = $validator;
        $this->children = $children;
    }
    
    public function make_event($root, $arguments)
    {  
        $parameters = $this->build_parameters($arguments);
               
        $result = (object)[
            "schema"=> (object)[
                'id'=>$this->event_id,
                'aggregate_id'=>$this->aggregate_id
            ],
            "domain"=> (object)[
                "aggregate_id"=>$root->id,
                'payload'=>$this->validator->validate($this->event_id, $parameters)
            ]
        ]; 
                
        return $result;
    }
    
    private function build_parameters($arguments)
    {
        $parameters = new \stdClass();
        if (!isset($this->children)) {
            return $parameters;
        }
        foreach ($this->children as $key=>$type_id) {
            $parameters->$key = current($arguments);
            next($arguments);
        }
        return $parameters;
    }
}

