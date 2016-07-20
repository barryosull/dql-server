<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;

class Using extends AbstractCommand implements Command
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
