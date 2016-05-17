<?php namespace Infrastructure\App\Interpreter\InterpreterPattern;

/**
 * Stub invariant for testing purposes
 */
class Invariant 
{
    private $result;
    
    public function __construct($result)
    {
        $this->result = $result;
    }
    
    public function check($arguments)
    {
        return $this->result;
    }
}
