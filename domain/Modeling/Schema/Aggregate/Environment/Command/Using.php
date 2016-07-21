<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;

/** @id 6cdac48b-a73f-458b-9224-766810458c0b */
class Using extends AbstractCommand implements Command
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
