<?php namespace Domain\DQL\Modelling\Aggregate\Database\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 5225203f-3ff0-44aa-9142-4da277e6c009 */
class Create extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Uuid $entity_id, Name $name)
    {
        parent::__construct($id, $entity_id);

        $this->name = $name;
    }
}
