<?php namespace Domain\DQL\Modelling\Entity;

use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

class Domain extends AbstractEntity 
{
    public $name;
    public $database_id;
    
    public function __construct(Uuid $id, Name $name, Uuid $database_id)
    {
        $this->name = $name;
        $this->database_id = $database_id;
        parent::__construct($id);
    } 
}