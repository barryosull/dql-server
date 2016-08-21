<?php namespace App\Projection\Database;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function set_name($id, $name);
    
    public function delete($id);
}
