<?php namespace App\Interpreter\Aggregate;

use App\Interpreter\Modification;
use App\Interpreter\EventLog;
use App\Interpreter\Validation;

class Interpreter
{    
    private $aggregate_id;
    private $defaults;
    private $root_entity_id;
    private $validator;
    private $modifier;
    private $event_log;
    
    public function __construct(
        $ast, 
        Validation\Validator $validator,
        Modification\Modifier $modifier,
        EventLog $event_log
    )
    {
        $this->aggregate_id = $ast->id;
        $this->defaults = $ast->root->defaults;
        $this->root_entity_id = $ast->root->entity_id;
        
        $this->validator = $validator;
        $this->event_log = $event_log;
        
        $this->modifier = $modifier;
    }
    
    public function build_root($entity_id)
    {        
        $entity_defaults = clone $this->defaults;
        $entity_defaults->id = $entity_id;
        
        $root_entity = $this->validator->validate($this->root_entity_id, $entity_defaults);
        
        $events = $this->event_log->fetch($entity_id, $this->aggregate_id);
        
        foreach ($events as $event) {
            $id = $event->schema->event_id;
            $root_entity = $this->modifier->modify($id, $root_entity, $event->payload);
        }
        
        return $root_entity;
    }
}



