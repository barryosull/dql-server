<?php namespace App\Interpreter\Query;

interface Interpreter
{
    public function query($root, $parameters);
}
