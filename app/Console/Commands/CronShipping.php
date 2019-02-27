<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\Models\Trans_detail;
use App\Models\Trans;
use DateTime;

class CronShipping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:shipping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengecek transaksi pengambilan barang, jika melebihi batas waktu barang sudah dianggap sampai ke pembeli dan dana diteruskan ke seller';

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
        $where .= ' AND sys_trans_detail.trans_detail_status IN (5)';
        $where .= ' AND sys_trans.trans_is_paid = 1';
        $where .= ' AND sys_trans_detail.trans_detail_no_resi != 0';
        $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 0';
        $trans_detail = Trans_detail::whereRaw($where)
            ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
            ->select('sys_trans_detail.*')
            ->get();
        $no = 0;

        if($trans_detail->count()){
            $trans = Trans::whereRaw($where)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->select('sys_trans.*')
                ->get();
            $this->info("Memulai pengecekan. . .");
            foreach ($trans_detail as $item) {
                $ship_status = FunctionLib::get_waybill($item->id);
                if($ship_status == "Sent"){
                    $difference = FunctionLib::daysBetween($item->trans_detail_send_date, $date, 'h');
                    $this->info('Transaksi detail '.$item->trans_code.' ordered at '.$item->trans->created_at);
                    $batas = FunctionLib::get_config('transaksi_durasi_shipping');
                    if($difference >= $batas){
                        // update trans detail
                        // $update = Trans_detail::findOrFail($item->id);
                        $item->trans_detail_status = 6;
                        $item->trans_detail_drop = 1;
                        $item->trans_detail_drop_date = date('y-m-d h:i:s');
                        $item->trans_detail_drop_note = "Transaktion dropping by system.";
                        $item->trans_detail_note = 'Transaksi di drop oleh sistem pada '.$date.'.';
                        $item->save();
                        $no++;
                        $this->info('transaksi '.$item->trans->trans_code.' dengan kode detail '.$item->trans_code.' expired at '.$date);
                        // update wallet
                        $this->info("prosses update wallet seller.");
                        // update saldo transaksi
                        $detail_amount = $item->trans_detail_amount;
                        $detail_amount_ship = $item->trans_detail_amount_ship;
                        $detail_fee = ($detail_amount*(FunctionLib::get_config('price_pajak_admin'))/100);

                        $detail_amount = round($detail_amount,8, PHP_ROUND_HALF_DOWN);
                        $detail_amount_ship = round($detail_amount_ship,8, PHP_ROUND_HALF_DOWN);
                        $detail_fee = round($detail_fee,8, PHP_ROUND_HALF_UP);
                        $detail_amount_total = $detail_amount-$detail_fee+$detail_amount_ship;
                        if($item->trans->trans_payment_id !== 4){
                            $update_wallet = [
                                'user_id'=>$item->produk->produk_seller_id,
                                'wallet_type'=>1,
                                'amount'=>$detail_amount_total,
                                'note'=>'Update wallet CW dengan transaksi detail kode '.$item->trans_code.' dan transaksi kode '.$item->trans->trans_code.'.',
                            ];
                            $saldo = FunctionLib::update_wallet($update_wallet);
                        }
                        $this->info('Wallet CW '.$item->produk->produk_seller_id.' ditambah sebesar '.$detail_amount_total.'.');
                    }
                }
            }
            if($trans->count()){
                $this->info("mengirim email ke seller.");
                foreach ($trans as $items) {
                    if($items->trans_detail->first()->trans_detail_status == 6){                        
                        $send_status = FunctionLib::trans_arr($items->trans_detail->first()->trans_detail_status);
                        $config = [
                            'to' => $items->trans_detail->first()->produk->user->email,
                            'data' => [
                                'trans_code' => $items->trans_code,
                                'trans_amount_total' => $items->trans_amount_total,
                                'status' => $send_status,
                            ]
                        ];
                        $send_notif = FunctionLib::transaction_notif($config);
                        $this->info("berhasil mengirim email ke ".$items->trans_detail->first()->produk->user->email.".");
                    }
                }
            }
        }else{
            $this->info("Data tidak ada.");
        }
        $this->info($no." Transaksi Expired.");
    }
}
