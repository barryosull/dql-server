<?php namespace App\EventLog;

use Ramsey\Uuid\Uuid;

class IDGenerator
{
    public function generate()
    {
        return Uuid::uuid4()->toString();
    }
}


