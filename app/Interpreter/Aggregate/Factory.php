<?php namespace App\Interpreter\Aggregate;

use App\Interpreter\Validation;
use App\Interpreter\Modification;
use App\Interpreter\EventLog;

class Factory
{    
    private $validator;
    private $modification;
    private $event_log;
 
    public function __construct(
        Validation\Validator $validator,
        Modification\Modifier $modification,
        EventLog $event_log
    )
    {
        $this->validator = $validator;
        $this->modification = $modification;
        $this->event_log = $event_log;
    }
    
    public function ast($ast)
    {
        return new Interpreter(
            $ast,
            $this->validator,
            $this->modification,
            $this->event_log
        );
    }
}



