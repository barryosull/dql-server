<?php namespace App\Interpreter\Query;

class NullInterpreter implements Interpreter
{   
    public function query($root, $parameters)
    {        
        return $root;
    }
}

