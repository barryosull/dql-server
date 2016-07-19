<?php namespace Test\EventLog\PDO;

use Test\EventLog\AbstractEventStreamLockerTest;
use Infrastructure\App\EventLog\PDO\EventStreamLocker;
use App\EventLog\DateTimeGenerator;

class EventStreamLockerTest extends AbstractEventStreamLockerTest
{    
    protected function make_locker(DateTimeGenerator $stub_datetime_generator)
    {
        $this->artisan('migrate');
        return new EventStreamLocker(self::$pdo, $stub_datetime_generator);
    }
}