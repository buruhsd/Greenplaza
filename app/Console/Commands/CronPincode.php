<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronPincode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:pincode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batas pembayaran pincode.';

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
