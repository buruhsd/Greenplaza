<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\Models\Trans_detail;
use App\Models\Trans;
use DateTime;

class CronCreateWalletById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:createby {--user_id=}';

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
            'cron_job_method' => 'wallet:createby',
            'cron_job_type' => 'start',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet By Id',
            'cron_job_note' => 'Memulai membuat wallet.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("Memulai persiapan. . .");

        $this->info("Memulai membuat wallet. . .");
        $user_id = ($this->option('user_id'))?$this->option('user_id'):0;
        if($this->option('user_id') == "admin"){
            $create = FunctionLib::create_wallet_user("admin");
            $status = ($create['status'] == 200)?'berhasil':'gagal';
        }else{
            $create = FunctionLib::create_wallet_user($this->option('user_id'));
            $status = ($create['status'] == 200)?'berhasil':'gagal';
        }

        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:createby',
            'cron_job_type' => 'process',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet By Id',
            'cron_job_note' => $status.' membuat wallet, pesan : '.$create['message'].'.'
        ];
        FunctionLib::add_cron($data_cron);

        $this->info($create['total']." wallet berhasil dibuat. . .");
        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:createby',
            'cron_job_type' => 'end',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Wallet By Id',
            'cron_job_note' => 'membuat wallet user berakhir.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("buat wallet selesai. . .");
        if($this->option('user_id') !== "admin"){
            $this->info("silahkan masukkan manual address wallet di sys_wallet anda jika wallet gln user anda baru saja dibuat. . .");
        }
    }
}
