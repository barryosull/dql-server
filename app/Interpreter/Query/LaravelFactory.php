<?php namespace App\Interpreter\Query;

use DB;

class LaravelFactory implements Factory
{       
    private $pdo;
    private $sql_factory;
    
    public function __construct(SQLFactory $sql_factory)
    {
        $this->pdo =  DB::connection()->getPdo();
        $this->sql_factory = $sql_factory;
    }
    
    public function ast($ast)
    {
        if (!$ast->query) {
            return new NullInterpreter();
        }
        $sql = $this->sql_factory->ast($ast);
        $statement = $this->pdo->prepare($sql);
        $value_factory = new ValueFactory($ast->query->where);
        return new Interpreter($statement, $value_factory);
    }   
}