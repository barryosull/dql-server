<?php namespace Domain\DQL\Modelling\Aggregate\Domain;

use BoundedContext\Sourced\Aggregate\AbstractAggregate;

/**
 * @id 333b4e5f-611a-42eb-80ac-3a885e04fa00
 */
class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Sourced\Aggregate\Aggregate
{
    protected function handle_create(Command\Create $command)
    {
        $this->check->that(Invariant\Created::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name, $command->database_id])
            ->not()
            ->asserts();
 
        $this->apply(new Event\Created(
            $command->id(),
            $command->database_id,
            $command->name
        ));
    }
    
    protected function handle_delete(Command\Delete $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->apply(new Event\Deleted(
            $command->id(),
            $this->state()->queryable()->name
        ));
    }
    
    protected function handle_rename(Command\Rename $command)
    {
        $this->check->that(Invariant\Created::class)
            ->asserts();

        $this->check->that(Invariant\NameAlreadyInUse::class)
            ->assuming([$command->name])
            ->not()
            ->asserts();
        
        $this->apply(new Event\Renamed(
            $command->id(),
            $this->state()->queryable()->name,
            $command->name
        ));
    }
}
