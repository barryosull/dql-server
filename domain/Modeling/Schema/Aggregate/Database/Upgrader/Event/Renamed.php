<?php namespace Domain\Modeling\Schema\Aggregate\Database\Upgrader\Event;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Renamed extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {

    }
}
