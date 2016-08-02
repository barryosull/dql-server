<?php namespace App\Projection\ID;

use Domain\Modeling\Schema\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    /**
     * @param Name $name
     * @return Uuid
     */
    public function id(Name $name);
    
    /**
     * @return Name[]
     */
    public function names();
}
