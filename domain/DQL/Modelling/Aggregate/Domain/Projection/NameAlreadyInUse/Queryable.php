<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse;

use Domain\DQL\Modelling\ValueObject\Name;
use EventSourced\ValueObject\ValueObject\Uuid;
use BoundedContext\ValueObject\Boolean;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    /**
     * Returns a boolean of whether or not the name is in use
     *
     * @param Name $name
     * @return Boolean
     */
    public function name_already_in_use(Name $name, Uuid $database_id);
}
