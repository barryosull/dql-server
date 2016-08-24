<?php namespace Test\AcceptanceAndUnit\Interpreter\Projection\Query;

use App\Interpreter\Query\MongoQueryFactory;

class MongoDBFactoryTest extends \Test\AcceptanceAndUnit\Interpreter\TestCase
{
    public function test_convert_invariant_ast_into_mongo_query()
    {
        $ast = $this->fake_ast_repo->invariant_projection();
        
        $factory = new MongoQueryFactory();
        
        $collection = 'aggregate_5e867d81_9e3f_4a33_9150_6f4b373ba74f';
        
        $query = [
            ['$match' => [
                'shopper_id' => '?',
                'is_created' => '?',
                'is_checked_out' => '?'
            ]],
            ['$group' => [
                '_id' =>'shopper_id',
                'cart_count' => ['$sum' => 1]
            ]],
        ];

        $mongo_query = [
            'collection' => $collection,
            'query' => $query
        ];
        
        $this->assertEquals($mongo_query, $factory->ast($ast));
    }
}