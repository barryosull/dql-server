<?php namespace Test\AcceptanceAndUnit\EventLog\PDO;

use Infrastructure\App\EventLog\PDO\EventRepository;
use Test\AcceptanceAndUnit\EventLog\AbstractEventRepositoryTest;

class EventRepositoryTest extends AbstractEventRepositoryTest
{    
    protected function build_event_repository()
    {
        $this->artisan('migrate', ['--path'=>'database/migrations/sqlite']);
        return new EventRepository(self::$pdo, $this->event_builder);
    }
    
    public function tearDown()
    {
        parent::tearDown();
        $this->artisan('migrate:rollback');
    }
}