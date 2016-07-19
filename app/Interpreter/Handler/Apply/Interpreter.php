<?php namespace App\Interpreter\Handler\Apply;

use App\Interpreter\Modification;

class Interpreter
{    
    private $event_interpreter;
    private $assert_interpreter;
    private $event_id;
    private $modification;
    private $arguments;
    
    public function __construct($event_interpreter, $assert_interpreter, $event_id, Modification\Modifier $modification, $arguments)
    {
        $this->event_interpreter = $event_interpreter;
        $this->assert_interpreter = $assert_interpreter;
        $this->event_id = $event_id;
        $this->modification = $modification;
        $this->arguments = $arguments ?: [];
    }
    
    public function interpret($root, $command)
    {       
        if ($this->assert_interpreter) {
            if (!$this->assert_interpreter->check($root, $command)) {
                return;
            }
        }
        $arguments = $this->extract_arguments($command);
        $event = $this->event_interpreter->make_event($root, $arguments);
        $this->modification->modify($this->event_id, $root, $event->domain->payload);
        return $event;
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


