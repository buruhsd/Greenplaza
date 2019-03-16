<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\Models\Trans_detail;
use App\Models\Trans;
use DateTime;

class CronCreateWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'membuat wallet user yang belum tersedia.';

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
        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:create',
            'cron_job_type' => 'start',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet',
            'cron_job_note' => 'Memulai membuat wallet.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("Memulai persiapan. . .");

        $this->info("Memulai membuat wallet. . .");
        $create = FunctionLib::create_wallet();
        $status = ($create['status'] == 200)?'berhasil':'gagal';

        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:create',
            'cron_job_type' => 'process',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet',
            'cron_job_note' => $status.' membuat wallet, pesan : '.$create['message'].'.'
        ];
        FunctionLib::add_cron($data_cron);
        
        $this->info($create['total']." wallet berhasil dibuat. . .");
        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:create',
            'cron_job_type' => 'end',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet',
            'cron_job_note' => 'mengecek transaksi menunggu kesanggupan seller berakhir.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("buat wallet selesai. . .");
    }
}
