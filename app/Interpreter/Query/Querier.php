<?php namespace App\Interpreter\Query;

use App\Interpreter\AstRepository;

class Querier 
{
    private $repo;
    private $factory;
    
    public function __construct(AstRepository $repo, Factory $factory)
    {
        $this->repo = $repo;
        $this->factory = $factory;
    }
    
    public function create($ast)
    {
        $this->repo->store($ast);
    }
    
    public function query($id, $root, $parameters)
    {
        $ast = $this->repo->fetch($id);
        
        if (!$ast->query) {
            return (new NullInterpreter())->query($root, $parameters);
        }

        $querier = $this->factory->ast($ast);
        
        return $querier->query($root, $parameters);
    }
}