<?php namespace Domain\DQL\Modelling\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;
use EventSourced\ValueObject\ValueObject\Uuid;
use Domain\DQL\Modelling\ValueObject\Name;

class Database extends AbstractEntity 
{
    public $name;
    
    public function __construct(Uuid $id, Name $name)
    {
        $this->name = $name;
        parent::__construct($id);
    } 
}