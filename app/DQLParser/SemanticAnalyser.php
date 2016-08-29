<?php namespace App\DQLParser;

use App\EventLog\IDGenerator;

class SemanticAnalyser
{
    private $id_generator;

    public function __construct(IDGenerator $id_generator)
    {
        $this->id_generator = $id_generator;
    }

    public function analyse($ast)
    {
        $id = $this->id_generator->generate();
        $ast->id = $id;
        return $ast;
    }
}