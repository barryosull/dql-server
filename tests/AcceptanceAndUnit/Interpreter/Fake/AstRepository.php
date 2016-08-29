<?php namespace Test\AcceptanceAndUnit\Interpreter\Fake;

class AstRepository implements \App\Interpreter\AstRepository
{
    private static $asts = [];
    private $ast_path = 'tests/AcceptanceAndUnit\Interpreter/asts';
    
    public function __call($name, $arguments)
    { 
        return $this->load_ast($name);
    } 
        
    public function load_ast($ast_file)
    {
        $file_path = $this->ast_path.'/'.$ast_file.".json";
        $full_file_path = base_path($file_path);
        
        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find AST '$ast_file'");
        }
        return json_decode(file_get_contents($full_file_path));
    }
    
    protected function preload_asts()
    {
        $folder_path = base_path($this->ast_path);

        $asts = array_diff(scandir($folder_path), array('..', '.'));

        foreach ($asts as $ast_file) {
            $ast = $this->load_ast(str_replace(".json", "", $ast_file));
            if (isset($ast->id)) {
                self::$asts[$ast->id] = $ast;
            }
        }
    }
    
    public function fetch($id)
    {
        if (count(self::$asts) == 0) {
            $this->preload_asts();
        }
        return self::$asts[$id];
    }

    public function store($ast)
    {
        //Not used
    }
}

