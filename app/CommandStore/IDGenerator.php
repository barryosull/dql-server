<?php namespace App\CommandStore;

use Rhumsaa\Uuid\Uuid;

class IDGenerator
{
    public function generate()
    {
        return Uuid::uuid4()->toString();
    }
}


