<?php namespace Domain\Modeling\Schema\Aggregate\Database\Upgrader\Command;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Rename extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {

    }
}
