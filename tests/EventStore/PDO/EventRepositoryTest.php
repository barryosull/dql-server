<?php namespace Test\EventStore\PDO;

use Infrastructure\App\EventStore\PDO\EventRepository;
use Test\EventStore\AbstractEventRepositoryTest;

class EventRepositoryTest extends AbstractEventRepositoryTest
{    
    public function setUp()
    {
        parent::setUp();
    }

    protected function build_event_repository()
    {
        $this->artisan('migrate');
        return new EventRepository(self::$pdo, $this->event_builder);
    }
}