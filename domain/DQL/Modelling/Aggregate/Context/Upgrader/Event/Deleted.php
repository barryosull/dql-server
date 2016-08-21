<?php namespace Context\DQL\Modelling\Aggregate\Context\Upgrader\Event;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Deleted extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
   
    }
}
