<?php namespace Infrastructure\App\EventLog\LaravelAdapter;

use App\EventLog\DateTimeGenerator;
use Infrastructure\App\EventLog\PDO;
use DB;

class EventStreamLocker extends PDO\EventStreamLocker
{
    public function __construct(DateTimeGenerator $datetime_generator)
    {
        parent::__construct(DB::connection()->getPdo(), $datetime_generator);
    }
}