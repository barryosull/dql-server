<?php namespace Context\DQL\Modelling\Aggregate\Context\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Context\DQL\Modelling\ValueObject\Name;

/** @id 3f338909-125e-4f27-91bf-bd0dbcd7aa90 */
class Rename extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Uuid $context_id, Name $name)
    {
        parent::__construct($id, $context_id);

        $this->name = $name;
    }
}
