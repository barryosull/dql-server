<?php namespace Test\AcceptanceAndUnit\PHPPegJs;

use Infrastructure\App\DQLParser\PHPPegJS;
use App\DQLParser\Parser;

class TestCase extends \Test\TestCase
{
    /** @var DQLRepository */
    protected $dql_repo;
    
    /** @var Parser */
    protected $parser;
    
    public function setUp()
    {
        parent::setUp();
        $this->dql_repo = new DQLRepository();
        $this->parser = $this->app->make(PHPPegJS\Parser::class);
    }
}