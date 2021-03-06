<?php namespace Test\AcceptanceAndUnit\EventLog;

class IDGeneratorTest extends \Test\TestCase
{    
    public function test_generates_uuid()
    {
        $id = (new \App\EventLog\IDGenerator())->generate();
        
        $this->assertRegExp("/([a-f\\d]{8}(-[a-f\\d]{4}){3}-[a-f\\d]{12}?)/i", $id);
    }
}