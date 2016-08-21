<?php namespace Domain\DQL\Modelling\Aggregate\Domain\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

/** @id 09436765-2fc5-4c19-a09e-195e795f51d7 */
class Rename extends AbstractCommand implements Command
{
    public $name;

    public function __construct(Uuid $id, Uuid $domain_id, Name $name)
    {
        parent::__construct($id, $domain_id);

        $this->name = $name;
    }
}
