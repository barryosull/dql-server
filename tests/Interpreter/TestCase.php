<?php namespace Test\Interpreter;

class TestCase extends \Test\TestCase
{
    protected $ast_repo;
    
    public function setUp()
    {
        $this->ast_repo = new AstRepository();
        $this->app()->bind(\PDO::class, Projection\MockPDO::class);
        $this->app()->bind(\App\Interpreter\InvariantRepository::class, InvariantRepository::class);
        $this->app()->bind(\App\Interpreter\EventRepository::class, EventRepository::class);
        $this->app()->bind(\App\Interpreter\EventHandlerRepository::class, EventHandlerRepository::class);
        $this->app()->bind(\App\Interpreter\ValueObjectRepository::class, ValueObjectRepository::class);
        $this->app()->bind(\App\Interpreter\HandlerRepository::class, HandlerRepository::class);
        $this->app()->bind(\App\Interpreter\EntityRepository::class, EntityRepository::class);
        
        parent::setUp();
    }
}