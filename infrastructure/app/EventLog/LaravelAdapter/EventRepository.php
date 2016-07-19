<?php namespace Infrastructure\App\EventLog\LaravelAdapter;

use App\EventLog\EventBuilder;
use Infrastructure\App\EventLog\PDO;
use DB;

class EventRepository extends PDO\EventRepository
{
    public function __construct(EventBuilder $event_builder)
    {
        parent::__construct(DB::connection()->getPdo(), $event_builder);
    }
}