<?php namespace Test\Interpreter\Handler\Invariant;

use App\Interpreter\Handler\Invariant;

class InterpreterTest extends \Test\Interpreter\TestCase
{
    protected $invariant_factory;
    protected $invariant;

    public function setUp()
    {
        parent::setUp();
        $ast = $this->fake_ast_repo->invariant();
        $this->invariant_factory = $this->app->make(Invariant\Factory::class);
        $this->invariant = $this->invariant_factory->ast($ast);
    }
    
    public function test_passing_invariant()
    {
        $root = (object)['is_created'=> true];
        
        $this->assertTrue($this->invariant->check($root));
    }
    
    public function test_failing_invariant()
    {
        $root = (object)['is_created'=> false];
        
        $this->assertFalse($this->invariant->check($root));
    }
    
    public function test_passing_arguments_to_invariant()
    {
        $ast = $this->fake_ast_repo->invariant_arguments();
        
        $invariant = $this->invariant_factory->ast($ast);
        
        $root = (object)[
            'shopper_id'=>"81684caa-ea4e-4ac3-bc54-60c4c89d8090",
            'is_created'=> true
        ];
        
        $arguments_true = ["81684caa-ea4e-4ac3-bc54-60c4c89d8090", true];
        $arguments_false = ["164b13f9-7208-4bbf-a63e-24dbe9691573", true];
        
        $this->assertTrue($invariant->check($root, $arguments_true));
        $this->assertFalse($invariant->check($root, $arguments_false));
    }
}
