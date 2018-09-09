<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class app extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install this cms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        //
        $this->execShellWithPrettyPrint('composer dump-autoload');
        $this->execShellWithPrettyPrint('php artisan migrate:rollback');
        $this->execShellWithPrettyPrint('php artisan migrate');
        $this->execShellWithPrettyPrint('php artisan key:generate');
        $this->execShellWithPrettyPrint('php artisan migrate --seed');
//        $this->execShellWithPrettyPrint('php artisan passport:install');
//        $this->execShellWithPrettyPrint('php artisan storage:link');
    }

    /**
     * Exec sheel with pretty print.
     *
     * @param  string $command
     * @return mixed
     */
    public function execShellWithPrettyPrint($command)
    {
        $this->info('---');
        $this->info($command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('---');
    }
}
