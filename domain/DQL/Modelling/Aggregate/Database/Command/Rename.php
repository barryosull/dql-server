<?php namespace Domain\DQL\Modelling\Aggregate\Database\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 4c057671-1457-4576-b99f-51afb0c1eb50 */
class Rename extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Uuid $entity_id, Name $name)
    {
        parent::__construct($id, $entity_id);

        $this->name = $name;
    }
}
