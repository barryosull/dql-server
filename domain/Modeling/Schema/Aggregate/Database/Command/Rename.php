<?php namespace Domain\Modeling\Schema\Aggregate\Database\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;

/** @id 4c057671-1457-4576-b99f-51afb0c1eb50 */
class Rename extends AbstractCommand implements Command
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
