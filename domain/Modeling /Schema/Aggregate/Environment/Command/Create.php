<?php namespace Domain\Modeling\Schema\Aggregate\Environment\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\Modeling\Schema\ValueObject\Name;

class Create extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);

        $this->name = $name;
    }
}
