<?php namespace App\Interpreter\Query\Property;

class Interpreter
{
    private $properties;
    private $literal;
    private $is_literal = false;
    
    public function __construct($ast)
    {
        if (isset($ast->literal)) {
            $this->literal = $ast->literal;
            $this->is_literal = true;
        } else {
            $this->properties = $ast->property;
            if (is_string($this->properties)) {
                $this->properties = [$this->properties];
            }
        }
    }
    
    public function extract_value($root, $parameters)
    {
        if ($this->is_literal) {
            return $this->literal;
        }
        
        $root_property = $this->properties[0];
        $node = isset($root->$root_property) ? $root : $parameters;

        foreach ($this->properties as $property) {
            $node = $node->$property;
        }
        return $node;
    }
}
