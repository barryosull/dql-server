<?php namespace App\Projection\Domain;

use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    /**
     * @param Uuid $database_id
     * @param Name $name
     * @return Uuid
     */
    public function id(Uuid $database_id, Name $name);
    
    /**
     * @return Name[]
     */
    public function names(Uuid $database_id);
}
