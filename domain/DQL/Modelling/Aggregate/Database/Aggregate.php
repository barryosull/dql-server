<?php namespace Domain\DQL\Modelling\Aggregate\Database;

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
            ->not()
            ->asserts();

        $this->apply(Event\Created::class,
            $command->name
        );
    }
    
    protected function handle_delete(Command\Delete $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->apply(Event\Deleted::class,
            $this->state()->queryable()->name
        );
    }
    
    protected function handle_rename(Command\Rename $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name])
            ->not()
            ->asserts();
        
        $this->apply(Event\Renamed::class,
            $this->state()->queryable()->name,
            $command->name
        );
    }
}
