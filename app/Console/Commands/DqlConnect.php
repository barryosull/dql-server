<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DqlConnect extends Command
{
    protected $signature = 'dql:connect';
    protected $description = 'Open up a DQL terminal';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line("\nWelcome to the DQL Server command line Interface.\n");
        while (true) {
            $command = $this->ask('Enter command');
            if ($this->is_exit_statement($command)) {
                break;
            }
            try {
                $response = $this->process_dql($command);
                $this->line(" ". $response);
            } catch (\Exception $e) {
                $this->error(" ".$e->getMessage()." ");
            }
        }
        $this->line('Goodbye.');
    }
    
    private function is_exit_statement($command)
    {
        return (strpos(trim($command), "exit") === 0);
    }
    
    private function process_dql($dql_statement) 
    {
        if (str_contains($dql_statement, "fail")) {
            throw new \Exception("Failure.");
        }
        return "Success\n";        
    }
}
