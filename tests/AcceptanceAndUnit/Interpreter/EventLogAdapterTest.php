<?php namespace Test\AcceptanceAndUnit\Interpreter;

use Infrastructure\App\Interpreter;
use App\EventLog;

class EventLogAdapterTest extends TestCase
{
    private $mock_event_log;
    private $event_builder;
    private $event_log;
    private $interpreter_event;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->mock_event_log = $this->mock(EventLog\EventLog::class);
        
        $stub_id_generator = $this->stub(EventLog\IDGenerator::class);
        $stub_id_generator->generate()->willReturn("87484542-4a35-417e-8e95-5713b8f55c8e");
        
        $stub_datetime_generator = $this->stub(EventLog\DateTimeGenerator::class);
        $stub_datetime_generator->generate()->willReturn('2014-10-10 12:12:12');
        
        $this->event_builder = new EventLog\EventBuilder(
            $stub_id_generator->reveal(), 
            $stub_datetime_generator->reveal()
        );
        
        $this->event_log = new Interpreter\EventLog(
            $this->mock_event_log->reveal(), 
            $this->event_builder
        );
        
        $this->interpreter_event = (object)[
            "schema"=> (object)[
                'id'=>'9be14fd0-80aa-4e82-bd30-df031a51f626',
                'aggregate_id'=>'01f99d4f-4cc7-4125-96fd-11f7dcbe8f9a'
            ],
            "domain"=> (object)[
                "command_id" => "88f2ecaa-81dd-467f-851d-cdd214f3f3bb",
                "aggregate_id"=> "ff3a666b-4288-4ecd-86d7-7f511a2fd378",
                'payload'=> (object)['data'=>true]
            ]
        ];
    }
    
    public function test_translates_event_before_storing_it()
    {
        $event = $this->interpreter_event;
        $this->event_builder->set_aggregate_id($event->domain->aggregate_id)       
            ->set_command_id($event->domain->command_id)
            ->set_schema_event_id($event->schema->id)
            ->set_schema_aggregate_id($event->schema->aggregate_id)
            ->set_payload($event->domain->payload);

        $transformed_event = $this->event_builder->build();
        
        $this->mock_event_log->store([$transformed_event])
            ->shouldBeCalled();
        
        $this->event_log->store([$this->interpreter_event]);
    }
        
    public function test_fetch()
    {
        $domain_aggregate_id = 'd';
        $schema_aggregate_id = 's';
        $stream = 's';
        
        $stream_id = new EventLog\StreamID($schema_aggregate_id, $domain_aggregate_id);
        
        $this->mock_event_log->fetch($stream_id)
            ->willReturn($stream)
            ->shouldBeCalled();                
        
        $this->assertEquals(
            $stream,
            $this->event_log->fetch($domain_aggregate_id, $schema_aggregate_id)
        );      
    }
}