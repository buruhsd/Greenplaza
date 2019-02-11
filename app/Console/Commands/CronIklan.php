<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronIklan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:iklan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batas pembayaran iklan.';

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
    }
}
