<?php namespace Domain\DQL\Modelling\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class Name extends AbstractSingleValue 
{
    protected function validator()
    {
        return parent::validator()->lowercase()->alnum('-.')->noWhitespace();
    }
}

