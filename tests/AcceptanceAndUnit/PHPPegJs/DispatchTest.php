<?php namespace Test\AcceptanceAndUnit\PHPPegJs;

use Symfony\Component\Yaml\Yaml;

class DispatchTest extends TestCase
{        
    public function test_parse_create_environment()
    {      
        return;
        $dql_statement = $this->load_dql(['dispatch', 'add-product']);
                
        $expected = $this->load_ast(['dispatch', 'add-product']);
        
        $actual = $this->parser->parse($dql_statement);
        
        $this->assertEquals($expected, $actual);
    }
    
    private function load_dql($path)
    {
        $ast_path = implode("/", $path);
        $file_path = 'tests/PHPPegJs/dqls/'.$ast_path.".dql";
        $full_file_path = base_path($file_path);
        
        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find DQL '$ast_path'");
        }
        return file_get_contents($full_file_path);
    }
    
    private function load_ast($path)
    {
        $ast_path = implode("/", $path);
        $file_path = 'tests/PHPPegJs/asts/'.$ast_path.".yaml";
        $full_file_path = base_path($file_path);
        
        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find AST '$ast_path'");
        }
        $ast_string = file_get_contents($full_file_path);
        return Yaml::parse($ast_string, false, false, true);
    }
}


