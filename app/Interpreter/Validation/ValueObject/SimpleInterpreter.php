<?php namespace App\Interpreter\Validation\ValueObject;

class SimpleInterpreter
{    
    private $check;
    private $name;
    
    public function __construct($check, $name="")
    {
        $this->check = $check;
        $this->name = $name;
    }
    
    public function validate($value)
    { 
        if (!$this->check->check($value)) {
            throw new ValueException("'$value' is not a valid value");
        }
        return $value;
    }
    
    public function check($value, $arguments=[])
    {
        return $this->check->check($value, $arguments);
    }
}



