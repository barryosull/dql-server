<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\DQLParser\DQLParser::class,
            \Infrastructure\App\DQLParser\PHPPegJS\DQLParser::class
        );
        
        $this->app->bind(
            \Infrastructure\App\DQLParser\PHPPegJS\CommandLine::class,
            \Infrastructure\App\DQLParser\PHPPegJS\CommandLine\Ubuntu::class
        );
        
        $this->app->bind(
            \App\DQLServer\Dispatcher::class,
            \App\Interpreter\Dispatch\DQLServerDispatcher::class
        );
        
        $this->app->bind(
            \App\Interpreter\AstRepository::class,
            \App\Domains\FileDirectoryAstRepository::class
        );
        

        /** EventLog **/
        $this->app->bind(
            \App\Interpreter\EventLog::class,
            \Infrastructure\App\Interpreter\EventLog::class
        );

        $this->app->bind(
            \App\EventLog\EventStreamLocker::class,
            \Infrastructure\App\EventLog\LaravelAdapter\EventStreamLocker::class
        );
        
        $this->app->bind(
            \App\EventLog\EventRepository::class,
            \Infrastructure\App\EventLog\LaravelAdapter\EventRepository::class
        );
        
        /** CommandStore **/
        $this->app->bind(
            \App\Interpreter\CommandStore::class,
            \Infrastructure\App\Interpreter\CommandStore::class
        );
        $this->app->bind(
            \App\CommandStore\CommandRepository::class,
            \Infrastructure\App\CommandStore\LaravelAdapter\CommandRepository::class  
        );
        
        /** Querier **/
        $this->app->bind(
            \App\Interpreter\Query\Factory::class,
            \App\Interpreter\Query\LaravelFactory::class
        );
        

    }
}
