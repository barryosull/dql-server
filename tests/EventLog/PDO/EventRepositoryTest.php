<?php namespace Test\EventLog\PDO;

use Infrastructure\App\EventLog\PDO\EventRepository;
use Test\EventLog\AbstractEventRepositoryTest;

class EventRepositoryTest extends AbstractEventRepositoryTest
{    
    protected function build_event_repository()
    {
        $this->artisan('migrate');
        return new EventRepository(self::$pdo, $this->event_builder);
    }
    
    public function tearDown()
    {
        parent::tearDown();
        $this->artisan('migrate:rollback');
    }
}