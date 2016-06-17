<?php namespace Test\Interpreter\Dispatch;

use App\Interpreter\Handler\Invariant;
use App\Interpreter\Dispatch\EventLockerDispatcher;
use App\EventStore\StreamID;

class EventLockerDispatcherTest extends \Test\Interpreter\TestCase
{
    private $mock_dispatch_interpreter;
    private $mock_locker;
    private $event_locker_dispatcher;
    private $command;
    private $stream_id;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->mock_dispatch_interpreter = $this->getMockBuilder(\App\Interpreter\Dispatch\Dispatcher::class)
            ->disableOriginalConstructor()->getMock();
        $this->mock_locker = $this->getMockBuilder(\App\EventStore\EventStreamLocker::class)
            ->disableOriginalConstructor()->getMock();
        
        $this->event_locker_dispatcher = new EventLockerDispatcher(
            $this->mock_locker,
            $this->mock_dispatch_interpreter
        );
             
        $this->command = (object)[
            "schema"=>(object)["aggregate_id"=>'s'],
            "domain"=>(object)["aggregate_id"=>'d']
        ];
        
        $this->stream_id = new StreamID("s", "d");
    }
            
    public function test_calls_lock_and_unlock()
    {        
        $this->mock_locker->expects($this->once())
                 ->method('lock')
                 ->with($this->equalTo($this->stream_id));
        
        $this->mock_locker->expects($this->once())
                 ->method('unlock')
                 ->with($this->equalTo($this->stream_id));
        
        $this->event_locker_dispatcher->dispatch($this->command);
    } 
    
    public function test_unlocks_if_there_is_an_error()
    {
        $this->mock_dispatch_interpreter->method('dispatch')
                ->will($this->throwException(new Invariant\Exception));
        
        $this->mock_locker->expects($this->once())
                 ->method('unlock')
                 ->with($this->equalTo($this->stream_id));
        
        $this->setExpectedException(Invariant\Exception::class);
        
        $this->event_locker_dispatcher->dispatch($this->command);
    }
}