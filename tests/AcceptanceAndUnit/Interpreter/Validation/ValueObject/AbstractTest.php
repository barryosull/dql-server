<?php namespace Test\AcceptanceAndUnit\Interpreter\Validation\ValueObject;

use App\Interpreter\Validation\ValueObject;

abstract class AbstractTest extends \Test\AcceptanceAndUnit\Interpreter\TestCase
{
    protected $factory;
    protected $interpreter;
    
    abstract protected function ast();
    
    public function setUp()
    {
        parent::setUp();
        $this->factory = $this->app->make(ValueObject\Factory::class);
        $this->interpreter = $this->factory->ast($this->ast());
    }
}
