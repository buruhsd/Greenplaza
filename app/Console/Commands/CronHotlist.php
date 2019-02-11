<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronHotlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:hotlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batas pembayaran hotlist.';

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
