<?php namespace Domain\Modeling\Schema\Aggregate\Database;

use BoundedContext\Sourced\Aggregate\AbstractAggregate;

/**
 * @id 58682452-69aa-465e-943d-5b4c997c93ca
 */
class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Sourced\Aggregate\Aggregate
{
    protected function handle_create(Command\Create $command)
    {
        $this->check->that(Invariant\Created::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name])
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\Created(
            $command->id(),
            $command->name
        ));
    }

    protected function handle_using(Command\Using $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();
        
        /* ---------------- */

        $this->apply(new Event\Used(
            $command->id()
        ));
    }
}
