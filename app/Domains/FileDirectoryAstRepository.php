<?php namespace App\Domains;

use Symfony\Component\Yaml\Yaml;

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
        if (isset(self::$asts[$ast->id])) {
            throw new \Exception("ID '$ast->id' is already in use.");
        }
        self::$asts[$ast->id] = $ast;
    }
        
    protected function load_ast($ast_file)
    {
        $file_path = $this->ast_path.$ast_file;
        $full_file_path = base_path($file_path);

        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find AST '$ast_file'");
        }
        $yaml = file_get_contents($full_file_path);
        $ast = Yaml::parse($yaml, Yaml::PARSE_OBJECT_FOR_MAP);
        return $ast;
    }
    
    protected function preload_asts()
    {
        $folder_path = base_path($this->ast_path);

        $asts_files = array_diff(scandir($folder_path), array('..', '.'));

        foreach ($asts_files as $ast_file) {
            $ast = $this->load_ast($ast_file);
            if (isset($ast->id)) {
                $this->store($ast);
            }
        }
    }
}

