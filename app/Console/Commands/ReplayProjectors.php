<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use BoundedContext\Laravel\Player\Collection\Builder as PlayerBuilder;

class ReplayProjectors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projectors:replay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replay all the Domain and Application Projections';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(PlayerBuilder $player_builder)
    {
        $players = $player_builder->all()->get();
        $players->reset();
        $players->play();
    }
}
