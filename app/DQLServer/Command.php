<?php namespace App\DQLServer;

use Ramsey\Uuid\Uuid;
use DateTime;

class Command 
{
    public $id;
    public $command_id;
    public $aggregate_id;
    public $payload;
    public $occured_at;
    
    public function __construct($command_id, $aggregate_id, $payload, $timestamp=null)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->command_id = $command_id;
        $this->aggregate_id = $aggregate_id;
        $this->payload = $payload;
        
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        
        $this->occured_at = $timestamp ?: $d->format("Y-m-d H:i:s.u");
    }
}