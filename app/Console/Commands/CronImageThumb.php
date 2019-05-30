<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;

class CronImageThumb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImageThumb:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'copy dan meresize produk image ke thumbnails';

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
            'cron_job_method' => 'ImageThumb:copy',
            'cron_job_type' => 'start',
            'cron_job_status' => 1,
            'cron_job_title' => 'Create Produk Image Thumb',
            'cron_job_note' => 'Memulai membuat thumbnail produk image.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("Memulai persiapan. . .");
        $this->info("Memulai membuat. . .");

        $total = FunctionLib::upload_thumb();

        $this->info($total." thumbnail produk image berhasil dibuat. . .");
        // log cron
        $data_cron = [
            'cron_job_method' => 'ImageThumb:copy',
            'cron_job_type' => 'end',
            'cron_job_status' => 1,
            'cron_job_title' => 'End Produk Image Thumb',
            'cron_job_note' => 'Selesai membuat thumbnail produk image.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info("menambahkan thumbnail produk image selesai. . .");
    }
}
