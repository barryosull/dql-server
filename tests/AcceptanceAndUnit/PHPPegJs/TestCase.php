<?php namespace Test\AcceptanceAndUnit\PHPPegJs;

use Infrastructure\App\DQLParser\PHPPegJS;
use App\DQLParser\DQLParser;

class TestCase extends \Test\TestCase
{
    /** @var DQLRepository */
    protected $dql_repo;
    
    /** @var DQLParser */
    protected $parser;
    
    public function setUp()
    {
        parent::setUp();
        $this->dql_repo = new DQLRepository();
        $this->parser = $this->app->make(PHPPegJS\DQLParser::class);
    }
}