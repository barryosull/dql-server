<?php namespace Test\AcceptanceAndUnit\CommandStore\PDO;

use Infrastructure\App\CommandStore\PDO\CommandRepository;
use Test\AcceptanceAndUnit\CommandStore\AbstractCommandRepositoryTest;

class CommandRepositoryTest extends AbstractCommandRepositoryTest
{    
    protected function build_repository()
    {
        $this->artisan('migrate', ['--path'=>'database/migrations/sqlite']);
        return new CommandRepository(self::$pdo, $this->builder);
    }
    
    public function tearDown()
    {
        parent::tearDown();
        $this->artisan('migrate:rollback');
    }
}