<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\Models\Trans_detail;
use DateTime;

class CronCheckout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengecek transaksi member melakukan transfer.';

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
        $date = date('Y-m-d H:i:s');
        $where = '1';
        $where .= ' AND trans_detail_status IN (1,2)';
        $where .= ' AND trans_detail_is_cancel = 0';
        $trans_detail = Trans_detail::whereRaw($where)->get();

        foreach ($trans_detail as $item) {
            $difference = FunctionLib::daysBetween($item->created_at, $date);
            $batas = FunctionLib::get_config('transaksi_durasi_checkout');
            if($difference >= $batas){
                $item->trans_detail_is_cancel = 1;
                $item->trans_detail_status = 4;
                $item->trans_detail_packing = 2;
                $item->trans_detail_packing_note = "Transaction be Cancel by seller";
                $item->trans_detail_note = 'Transaksi Dibatalkan oleh sistem. Checkout transaksi Expired.';
                $item->save();
            }
        }
    }
}
