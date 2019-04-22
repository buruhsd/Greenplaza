<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\User;
use App\Models\User_config;
use DateTime;

class CronCreateConfigUserById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ConfigUser:by {--name=} {--user_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'membuat config user ex: ConfigUser:by --name=tes --user_id=2}.';

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
            'cron_job_method' => 'ConfigUser:by',
            'cron_job_type' => 'start',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create config user',
            'cron_job_note' => 'Memulai menambahkan config.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("Memulai persiapan. . .");

        $this->info("Memulai membuat. . .");
        $user_id = (is_numeric($this->option('user_id')))
            ?$this->option('user_id')
            :(($this->option('user_id') == "all")
                ?"all"
                :0);
        $name = ($this->option('name'))
            ?$this->option('name')
            :0;
        $total = 0;
        if($user_id === 0 || $name === 0){
            // log cron
            $data_cron = [
                'cron_job_method' => 'ConfigUser:by',
                'cron_job_type' => 'prosses',
                'cron_job_status' => 1,
                'cron_job_title' => 'Create config user',
                'cron_job_note' => 'command tidak valid!'
            ];
            FunctionLib::add_cron($data_cron);
            $this->error('command salah!');
            exit;
        }else{
            $arr = FunctionLib::UserConfigArr();
            if($name == "all"){
                foreach ($arr as $item) {
                    $param = [
                        'id' => $user_id,
                        'name' => $item['name'],
                        'value' => $item['value'],
                        'note' => $item['note'],
                    ];
                    $create = FunctionLib::CreateUserConfig($param);
                    $total = $total + $create['total'];

                    $status = ($create['status'] == 200)?'berhasil':'gagal';
                    // log cron
                    $data_cron = [
                        'cron_job_method' => 'ConfigUser:by',
                        'cron_job_type' => 'process',
                        'cron_job_status' => 1,
                        'cron_job_title' => 'Create config user',
                        'cron_job_note' => $status.' membuat config user, total : '.$create['total'].' row, pesan : '.$create['message'].'.'
                    ];
                    FunctionLib::add_cron($data_cron);
                }
            }else{
                $param = [
                    'id' => $user_id,
                    'name' => $name,
                    'value' => $arr[$name]['value'],
                    'note' => 'Besar % poin untuk pembayaran dengan poin masedi & saldo masedi.',
                ];
                $create = FunctionLib::CreateUserConfig($param);
                $total = $total + $create['total'];

                $status = ($create['status'] == 200)?'berhasil':'gagal';
                // log cron
                $data_cron = [
                    'cron_job_method' => 'ConfigUser:by',
                    'cron_job_type' => 'process',
                    'cron_job_status' => 1,
                    'cron_job_title' => 'Create config user',
                    'cron_job_note' => $status.' membuat config user, total : '.$create['total'].' row, pesan : '.$create['message'].'.'
                ];
                FunctionLib::add_cron($data_cron);
            }
        }

        $this->info($total." config user berhasil dibuat. . .");
        // log cron
        $data_cron = [
            'cron_job_method' => 'wallet:createby',
            'cron_job_type' => 'end',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create config user',
            'cron_job_note' => 'menambahkan config user berakhir.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("menambahkan config user selesai. . .");
    }
}
