<?php namespace Test\AcceptanceAndUnit\PHPPegJs\Fake;

class DQLRepository
{
    private $ast_path = 'tests/AcceptanceAndUnit\PHPPegJs/dqls';

    public function load_dql($dql_file)
    {
        $file_path = $this->ast_path.'/'.$dql_file.".dql";
        $full_file_path = base_path($file_path);

        if (!is_file($full_file_path)) {
            throw new \Exception("Cannot find DQL '$dql_file'");
        }
        return file_get_contents($full_file_path);
    }
}
