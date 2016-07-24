<?php namespace Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse;

use Domain\Modeling\Schema\ValueObject\Name;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    /**
     * Adds a new name
     *
     * @param Name $name
     * @return void
     */
    public function create(Name $name);
}
