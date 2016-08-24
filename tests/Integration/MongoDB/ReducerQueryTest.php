<?php namespace Test\Integration\MongoDB;

class ReducerQueryTest extends \Test\TestCase
{    
    private $game_collection;
    
    public function setUp()
    {
        parent::setUp();
        $db = (new \MongoDB\Client)->testing;
        $this->game_collection = $db->games;
        $this->game_collection->deleteMany([]);
        
        $this->add_game("Bloodborne", 10, 'eur');
        $this->add_game("Bloodborne", 15, 'usd');
        $this->add_game("Bloodborne", 20, 'eur');
        $this->add_game("Bloodborne", 30, 'eur');
    }
    
    private function add_game($name, $amount, $currency) 
    {
        $value = [
            "name"=>$name, 
            "price"=>[
                'amount'=>$amount,
                'currency'=>$currency
            ]
        ];
        
        $this->game_collection->insertOne($value);
    }
    
    public function test_reducing_a_data_set()
    {
        $query = [
            [
                '$match' => [
                    'price.amount' => [
                        '$lt' => 25,
                    ],
                    'price.currency' => 'eur'
                ]
            ],
            [
                '$group' => [
                    '_id' => null,
                    'game_count' => ['$sum' => 1]
                ]
            ]
        ];
        
        $result = $this->game_collection->aggregate($query)->toArray();
        
        $this->assertEquals(2, $result[0]->game_count);
    }
    
    public function test_no_results_in_reduction()
    {
        $query = [
            [
                '$match' => [
                    'price.amount' => [
                        '$lt' => 5,
                    ],
                    'price.currency' => 'eur'
                ]
            ],
            [
                '$group' => [
                    '_id' => null,
                    'game_count' => ['$sum' => 1]
                ]
            ]
        ];
        
        $result = $this->game_collection->aggregate($query)->toArray();
        $this->assertEmpty($result);
    }
}


