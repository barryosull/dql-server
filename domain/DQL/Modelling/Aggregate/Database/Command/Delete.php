<?php namespace Domain\DQL\Modelling\Aggregate\Database\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 25b11ced-9875-4ad9-9169-180cb9e08fd7 */
class Delete extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Name $name)
    {
        parent::__construct($id);

        $this->name = $name;
    }
}
