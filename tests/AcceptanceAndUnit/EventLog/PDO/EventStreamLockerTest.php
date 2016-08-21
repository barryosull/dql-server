<?php namespace Test\AcceptanceAndUnit\EventLog\PDO;

use Test\AcceptanceAndUnit\EventLog\AbstractEventStreamLockerTest;
use Infrastructure\App\EventLog\PDO\EventStreamLocker;
use App\EventLog\DateTimeGenerator;

class EventStreamLockerTest extends AbstractEventStreamLockerTest
{    
    protected function make_locker(DateTimeGenerator $stub_datetime_generator)
    {
        $this->artisan('migrate', ['--path'=>'database/migrations/sqlite']);
        return new EventStreamLocker(self::$pdo, $stub_datetime_generator);
    }
}