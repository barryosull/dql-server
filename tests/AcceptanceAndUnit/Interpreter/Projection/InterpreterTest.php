<?php namespace Test\AcceptanceAndUnit\Interpreter\Projection;

use App\Interpreter\Update;
use App\Interpreter\Handler\Invariant;

class InterpreterTest extends \Test\AcceptanceAndUnit\Interpreter\TestCase
{
    protected $root;

    public function setUp()
    {
        parent::setUp();
        
        $this->root = (object)[
            'shopper_id' => '5d37e24a-f833-45f3-90b1-3ac70fd05ac4',
            'is_created' => false
        ];
    }
    
    public function test_query_returns_false_initially()
    {
        $result = $this->invariant()->check($this->root);
        $this->assertFalse($result);
    }
    
    private function invariant()
    {
        $ast = $this->fake_ast_repo->invariant();
        $invariant_factory = $this->app->make(Invariant\Factory::class);
        return $invariant_factory->ast($ast);
    }
    
    public function test_query_returns_false_for_different_shopper_id()
    {
        $this->root->shopper_id = 'c6955003-814c-4f55-b907-006d7563579b';
        
        $result = $this->invariant()->check($this->root);
        $this->assertFalse($result);
    }  
}
