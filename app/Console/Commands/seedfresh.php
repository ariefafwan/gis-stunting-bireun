<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class seedfresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->info('Successfully for Tables Fresh & Run Seeder.');
    }
}
