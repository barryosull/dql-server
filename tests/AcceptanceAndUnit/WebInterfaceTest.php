<?php namespace Test\AcceptanceAndUnit;

class WebInterfaceTest extends \Test\TestCase
{        
    public function test_load_form()
    {
        $response = $this->call('GET', 'dql/form');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(strlen($response->getContent()) > 0);
    }
    
    public function test_make_invalid_request()
    {
        $data = [];
        $headers = ['HTTP_X-Requested-With'=> 'XMLHttpRequest'];
        $response = $this->call('POST', 'dql/command-dispatch', $data, [], [], $headers);
        $this->assertEquals(400, $response->getStatusCode());
    }
}


