<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HostingEnds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hosting-ends';

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
        \App\Libraries\Helper::hostingEnds();
    }
}
