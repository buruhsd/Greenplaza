<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronPacking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:packing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengecek transaksi seller melakukan packing dan mengirim resi';

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
