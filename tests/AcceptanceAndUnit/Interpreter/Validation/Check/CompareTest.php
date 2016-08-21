<?php namespace Test\AcceptanceAndUnit\Interpreter\Validation\Check;

use App\Interpreter\Validation\Compare;

class CompareTest extends \Test\AcceptanceAndUnit\Interpreter\TestCase
{
    private $factory;
    private $interpreter;
    
    public function setUp()
    {
        parent::setUp();
        $ast = $this->fake_ast_repo->valueobject_simple();
        $this->factory = $this->app->make(Compare\Factory::class);
        $this->interpreter = $this->factory->ast($ast->check->condition[0]);
    }
    
    public function test_pass()
    {
        $this->assertTrue($this->interpreter->check(1));
    }
    
    public function test_fail()
    {
        $this->assertFalse( $this->interpreter->check(-1) );
    }
    
    public function test_handles_properties()
    {
        $ast = $this->fake_ast_repo->invariant();
        $this->factory = $this->app->make(Compare\Factory::class);
        $this->interpreter = $this->factory->ast($ast->check->condition[0]);
        
        $this->assertFalse($this->interpreter->check((object)['is_created'=>false]));
    }
    
    public function test_can_handle_tiered_list_properties()
    {
        $ast = $this->fake_ast_repo->invariant();
        
        //Update invariant to use list of properties
        $ast->check->condition[0]->value_left->property = ["user", "is_created"];
               
        $this->factory = $this->app->make(Compare\Factory::class);
        $this->interpreter = $this->factory->ast($ast->check->condition[0]);
        
        $object = (object)[
            'user'=>(object)[
                'is_created'=>false
            ]
        ];
        
        $this->assertFalse($this->interpreter->check($object));
    }
}
