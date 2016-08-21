<?php namespace Context\DQL\Modelling\Aggregate\Context;

use BoundedContext\Sourced\Aggregate\AbstractAggregate;

/**
 * @id c49ec767-9469-4ca0-b608-89573fa71f61
 */
class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Sourced\Aggregate\Aggregate
{
    protected function handle_create(Command\Create $command)
    {
        $this->check->that(Invariant\Created::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name, $command->domain_id])
            ->not()
            ->asserts();
 
        $this->apply(Event\Created::class,
            $command->database_id,
            $command->name
        );
    }
    
    protected function handle_delete(Command\Delete $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->apply(Event\Deleted::class,
            $this->state()->queryable()->name()
        );
    }
    
    protected function handle_rename(Command\Rename $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name, $this->state()->queryable()->domain_id])
            ->not()
            ->asserts();
        
        $this->apply(Event\Renamed::class,
            $this->state()->queryable()->name(),
            $command->name
        );
    }
}
