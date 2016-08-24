<?php namespace App\Interpreter\Query;

class LaravelFactory implements Factory
{
    public function __construct()
    {
        
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