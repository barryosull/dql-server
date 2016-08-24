<?php namespace Test\AcceptanceAndUnit\Interpreter\Projection\Query;

use App\Interpreter\Query\Factory;
use Infrastructure\App\Interpreter\MongoDBRootEntityStore;
use Rhumsaa\Uuid\Uuid;

/*
 * Acceptance test for the query concept
 */
class QueryInterpreterAcceptanceTest extends \Test\AcceptanceAndUnit\Interpreter\TestCase
{
    private $interpreter;
    private $root_entity_store;
    
    private $root;
    private $shopper_id;
    private $collection_id;
    
    public function setUp()
    {
        parent::setUp();
                
        $factory = $this->app->make(Factory::class);
        
        $this->root_entity_store = new MongoDBRootEntityStore();
        $this->root_entity_store->clear();

        $this->shopper_id = "0595579e-faf5-4d38-8ecc-8a057de6e6d8";
        $this->collection_id = "5e867d81-9e3f-4a33-9150-6f4b373ba74f";
        
        $this->root = new \stdClass();

        $ast = $this->fake_ast_repo->invariant_projection();
        
        $this->interpreter = $factory->ast($ast);
    }
    
    public function test_query_with_results()
    {
        $this->when_cart(true, true);
        $this->when_cart(true, false);
        
        $parameters = (object)['shopper_id'=>$this->shopper_id];
        
        $result = $this->interpreter->query($this->root, $parameters);
        
        $this->assertEquals(1, $result->cart_count);        
    }
    
    private function when_cart($is_created, $is_checked_out)
    {
        $cart_root_entity =(object) [
            'id' => Uuid::uuid4()->toString(),
            'shopper_id'=>$this->shopper_id,
            'is_created'=>$is_created,
            'is_checked_out'=>$is_checked_out
        ];
        
        $this->root_entity_store->store($this->collection_id, $cart_root_entity);
    }
    
    public function test_no_results_for_different_shopper()
    {
        $this->when_cart(true, false);
        
        $parameters = (object)[
            'shopper_id'=>'4a178b27-1719-4493-8217-e03f3b51042b'
        ];
        
        $result = $this->interpreter->query($this->root, $parameters);
        
        $this->assertEquals(0, $result->cart_count);
    }
    
    public function test_no_results_if_no_active_carts()
    {
        $this->when_cart(true, true);
        $this->when_cart(true, true);
        
        $parameters = (object)['shopper_id'=>$this->shopper_id];
        
        $result = $this->interpreter->query($this->root, $parameters);
        
        $this->assertEquals(0, $result->cart_count);  
    }
}