<?php namespace App\Interpreter\Query\Mongo;

use MongoDB\Client;

class Factory implements \App\Interpreter\Query\Factory
{
    public function ast($ast)
    {
        return new Interpreter($ast, new Client());
    }   
}