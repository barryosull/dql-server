<?php namespace App\Interpreter\Query;

interface Factory 
{       
    public function ast($ast);
}