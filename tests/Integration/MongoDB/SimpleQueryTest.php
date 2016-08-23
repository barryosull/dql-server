<?php namespace Test\Integration\MongoDB;

class SimpleQueryTest extends \Test\TestCase
{    
    private $game_collection;
    
    public function setUp()
    {
        parent::setUp();
        $db = (new \MongoDB\Client)->testing;
        $this->game_collection = $db->games;
        
        $this->game_collection->insertOne(["name"=>"Bloodborne"]);
    }
    
    public function test_returns_null_if_no_match()
    {
        $game = $this->game_collection->findOne(['name' => 'My Little Pony']);
        $this->assertNull($game);
    }
    
    public function test_returns_row_if_match()
    {
        $game = $this->game_collection->findOne(['name' => 'Bloodborne']);
        $this->assertEquals("Bloodborne", $game->name);
    }
    
    public function test_delete_all()
    {
        $this->game_collection->deleteMany([]);
        $game = $this->game_collection->findOne(['name' => 'Bloodborne']);
        $this->assertNull($game);
    }
}


