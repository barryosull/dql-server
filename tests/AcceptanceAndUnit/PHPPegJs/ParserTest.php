<?php namespace Test\AcceptanceAndUnit\PHPPegJs;

use App\EventLog\IDGenerator;
use Test\AcceptanceAndUnit\Interpreter\Fake\AstRepository;
use Test\AcceptanceAndUnit\PHPPegJs\Fake\DQLRepository;

class ParserTest extends TestCase
{
    protected $parser;
    protected $semantic_analyser;
    protected $id_generator;
    protected $ast_repo;
    protected $dql_repo;

    public function setUp()
    {
        $id_generator = $this->prophesize(IDGenerator::class);
        $this->app->bind(IDGenerator::class, function($app) use ($id_generator){
           return $id_generator->reveal();
        });

        $this->parser = $this->app->make(\App\DQLParser\Parser::class);
        $this->semantic_analyser = $this->app->make(\App\DQLParser\SemanticAnalyser::class);

        $this->dql_repo = new DQLRepository();
        $this->ast_repo = new AstRepository();
    }

    /**
     * @dataProvider parserProvider
     */
    public function test_parser_turns_dql_into_asts_for_each_type($id, $file_name)
    {
        $expected = $this->ast_repo->load_ast($file_name);
        $this->id_generator->generate()->willReturn($id);

        $dql = $this->dql_repo->load_dql($file_name);
        $ast = $this->parser->parse($dql);
        $actual = $this->semantic_analyser->analyse($ast);

        $this->assertEquals($expected, $actual);
    }

    public function parserProvider()
    {
        return [
            "a6a70ade-d3be-42ba-bf6d-c29d055e862e" => "valueobject_validator",
            "4ea61742-409a-48b6-9563-2587c681f838" => "valueobject_simple",
            "dd7a3027-323c-484d-afc5-a9c6eb166221" => "valueobject_boolean",
            //"33490f62-8be7-4e74-b130-f2f6bc42567c" => "valueobject_composite",
        ];
    }
}