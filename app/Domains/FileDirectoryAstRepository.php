<?php namespace App\Domains;

class FileDirectoryAstRepository implements \App\Interpreter\AstRepository
{
    private static $asts = [];
    private $ast_path;
    
    public function __construct()
    {
        $this->ast_path = 'app/Domains/Ecommerce/AST/';
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
        
    protected function load_ast($ast_file)
    {
        $file_path = $this->ast_path.$ast_file.".yaml";
        $full_file_path = base_path($file_path);
        
        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find AST '$ast_file'");
        }
        $ast = yaml_parse_file($full_file_path);
        
        return json_decode(json_encode($ast));
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
}

