<?php namespace App\Interpreter\Handler\Invariant;

use App\Interpreter\Validation\Validator;
use App\Interpreter\Query\Querier;

class Interpreter
{    
    private $querier;
    private $validator;
    private $ast;
        
    public function __construct(Querier $querier, Validator $validator, $ast)
    {
        $this->querier = $querier;
        $this->validator = $validator;
        $this->ast = $ast;
    }
    
    public function check($root, $arguments=null)
    { 
        $parameters = $this->build_parameters($arguments);
        $data = $this->querier->query($this->ast->id, $root, $parameters);
        return $this->validator->check($this->ast->id, $data, $parameters);
    }
    
    private function build_parameters($arguments)
    {
        $parameters = new \stdClass();
        if (!isset($this->ast->parameters)) {
            return $parameters;
        }
        foreach ($this->ast->parameters as $key=>$type_id) {
            $parameters->$key = current($arguments);
            next($arguments);
        }
        return $parameters;
    }
}



