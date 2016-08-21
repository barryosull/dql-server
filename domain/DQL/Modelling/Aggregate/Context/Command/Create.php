<?php namespace Context\DQL\Modelling\Aggregate\Context\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Uuid;
use Context\DQL\Modelling\ValueObject\Name;

/** @id 05f5886e-0524-44df-b108-c185e4ff9857 */
class Create extends AbstractCommand implements Command
{
    public $domain_id;
    public $name;
        
    public function __construct(Uuid $id, Uuid $context_id, Uuid $domain_id, Name $name)
    {
        parent::__construct($id, $context_id);
        $this->name = $name;
        $this->domain_id = $domain_id;
    }
}
