<?php namespace App\Projection\Domain;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function set_name($id, $name, $database_id);
    
    public function update_name($domain_id, $name);
    
    public function delete($id);
}
