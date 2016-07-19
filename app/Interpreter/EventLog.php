<?php namespace App\Interpreter;

interface EventLog
{
    public function fetch($domain_aggregate_id, $schema_aggregate_id);
    
    public function store(array $events);
}
