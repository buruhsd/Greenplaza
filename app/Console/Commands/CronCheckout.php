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
        $where .= ' AND sys_trans.trans_is_paid = 0';
        $where .= ' AND trans_detail_is_cancel = 0';
        $trans_detail = Trans_detail::whereRaw($where)
            ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
            ->select('sys_trans_detail.*')
            ->get();
        $no = 0;

        if($trans_detail->first()->exists()){
            $this->info("Memulai pengecekan. . .");
            foreach ($trans_detail as $item) {
                $difference = FunctionLib::daysBetween($item->trans->created_at, $date);
                $this->info('Transaksi detail '.$item->trans_code.' ordered at '.$item->trans->created_at);
                $batas = FunctionLib::get_config('transaksi_durasi_checkout');
                if($difference >= $batas){
                    // update trans detail
                    // $update = Trans_detail::findOrFail($item->id);
                    $item->trans_detail_is_cancel = 1;
                    $item->trans_detail_status = 2;
                    $item->trans_detail_transfer = 2;
                    $item->trans_detail_transfer_date = $date;
                    $item->trans_detail_transfer_note = 'Transaktion cancel by system.';
                    $item->trans_detail_note = 'Transaksi Dibatalkan oleh sistem. Checkout transaksi Expired at '.$date.'.';
                    $item->save();
                    $no++;
                    $this->info('transaksi '.$item->trans->trans_code.' dengan kode detail '.$item->trans_code.' expired at '.$date);
                    // update stok produk
                    $this->info("prosses mengembalikan stok produk.");
                    $item->produk->produk_stock = $item->produk->produk_stock + $item->trans_detail_qty;
                    $item->produk->save();
                    $this->info('stok produk '.$item->produk->produk_name.' ditambah '.$item->trans_detail_qty.'.');
                }
            }
        }else{
            $this->info("Data tidak ada.");
        }
        $this->info($no." Transaksi Expired.");
    }
}
