<?php namespace Test\AcceptanceAndUnit\EventLog;

class DateTimeGeneratorTest extends \Test\TestCase
{    
    public function test_generates_datetime_with_microtime()
    {
        $datetime = (new \App\EventLog\DateTimeGenerator())->generate();
        $this->assertTrue(strtotime($datetime) !== false);
        $this->assertContains(".", $datetime);
    }
}