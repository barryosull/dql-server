<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id c82e449e-9706-46e9-b621-0447f9f6d9e0 */
class Delete extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);

        $this->name = $name;
    }
}
