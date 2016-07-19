<?php namespace App\Interpreter\Handler\Assert;

use App\Interpreter\Handler\Invariant;

class Interpreter
{    
    private $invariant;
    private $comparator;
    private $arguments;
    
    public function __construct(Invariant\Interpreter $invariant, $comparator, $arguments)
    {
        $this->invariant = $invariant;
        $this->comparator = $comparator;
        $this->arguments = $arguments ?: [];
    }
    
    public function interpret($root, $command)
    {
        $result = $this->check($root, $command);
        
        if (!$result) {
            throw new Invariant\Exception("Failure");
        }
    }
    
    public function check($root, $command) 
    {
        $arguments = $this->extract_arguments($command);
        $result = $this->invariant->check($root, $arguments);

        if ($this->comparator == 'not') {
            $result = !$result;
        }
        
        return $result;
    }
    
    private function extract_arguments($command)
    {
        $arguments = [];
        foreach ($this->arguments as $argument){
           $arguments[] = $this->extract_argument($argument, $command); 
        }
        
        return $arguments;
    }
    
    private function extract_argument($argument_path, $command)
    {
        $value = $command;
        
        if ($argument_path[0] == 'command') {
            unset($argument_path[0]);
        }
        foreach ($argument_path as $argument) {
            $value = $value->$argument;
        }
        return $value;
    }
}



