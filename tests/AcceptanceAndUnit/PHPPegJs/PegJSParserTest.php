<?php namespace Test\AcceptanceAndUnit\PHPPegJS;

require_once 'CommandLine/Valid.php';
require_once 'CommandLine/Invalid.php';

class PegJSParserTest extends TestCase
{        
    /**
     * Contract tests
     */
    public function test_parse_create_environment()
    {       
        $dql_statement = "create database 'test';";
        $ast = json_decode('{
            "type": "command",
            "name": "CreateDatabase",
            "value": "test"
        }');
                
        $parser = $this->app->make(\Infrastructure\App\DQLParser\PHPPegJS\Parser::class);
        
        $this->assertEquals($ast, $parser->parse($dql_statement));
    }
    
    public function test_parse_failure()
    {
        $dql_statement = "create bleh";
        $this->expectException(\App\DQLParser\ParserError::class);
        
        $parser = $this->app->make(\Infrastructure\App\DQLParser\PHPPegJS\Parser::class);
        $parser->parse($dql_statement);
    }
    
    /**
     * Implementation specific
     */
    
    public function test_rebuild_on_schema_update()
    {
        $generator = new \Infrastructure\App\DQLParser\PHPPegJS\ParserGenerator( new \Invalid());
        $parser = new \Infrastructure\App\DQLParser\PHPPegJS\Parser($generator);
        
        //The exception thrown by an invalid build, proves the builder was called
        $this->expectException(\Exception::class);

        touch(base_path("infrastructure/app/DQLParser/PHPPegJS/PegJSGrammar.pegjs"));
        
        $dql_statement = "create database 'test';";
 
        try {
            $parser->parse($dql_statement);
        }  catch (\Exception $e) {
            touch(base_path("infrastructure/app/DQLParser/PHPPegJS/GeneratedParser.php"));
            throw $e;
        } 
    }
}


