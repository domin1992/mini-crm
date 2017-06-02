<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \App\Libraries\Helper::getCompanies();
    }
}
