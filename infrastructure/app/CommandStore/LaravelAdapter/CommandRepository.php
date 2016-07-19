<?php namespace Infrastructure\App\CommandStore\LaravelAdapter;

use App\CommandStore\CommandBuilder;
use Infrastructure\App\CommandStore\PDO;
use DB;

class CommandRepository extends PDO\CommandRepository
{
    public function __construct(CommandBuilder $builder)
    {
        parent::__construct(DB::connection()->getPdo(), $builder);
    }
}