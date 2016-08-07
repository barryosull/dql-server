<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id b4854a80-1f3c-45c4-bfb2-0a68ab47821e */
class Create extends AbstractCommand implements Command
{
    public $database_id;
    public $name;
        
    public function __construct(Uuid $id, Uuid $database_id, Name $name)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->database_id = $database_id;
    }
}
