<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FunctionLib;
use App\Models\Trans_detail;
use App\Models\Trans;
use DateTime;

class CronAble extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:able';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengecek transaksi penyanggupan seller.';

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
            'cron_job_method' => 'trans:able',
            'cron_job_type' => 'start',
            'cron_job_status' => 1,
            'cron_job_title' => 'Transaksi Tunggu Seller',
            'cron_job_note' => 'memulai mengecek transaksi menunggu kesanggupan seller.'
        ];
        FunctionLib::add_cron($data_cron);

        $date = date('Y-m-d H:i:s');
        $where = '1';
        $where .= ' AND trans_detail_status IN (3)';
        $where .= ' AND sys_trans.trans_is_paid = 1';
        $where .= ' AND trans_detail_able = 0';
        $where .= ' AND trans_detail_packing = 0';
        $where .= ' AND trans_detail_is_cancel = 0';
        $trans_detail = Trans_detail::whereRaw($where)
            ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
            ->select('sys_trans_detail.*')
            ->get();
        $no = 0;
        $mail_send = [];

        if($trans_detail->count()){
            // log cron
            $data_cron = [
                'cron_job_method' => 'trans:able',
                'cron_job_type' => 'process',
                'cron_job_status' => 1,
                'cron_job_title' => 'Transaksi Tunggu Seller',
                'cron_job_note' => 'transaksi dengan status menunggu kesanggupan seller tersedia.'
            ];
            FunctionLib::add_cron($data_cron);

            $trans = Trans::whereRaw($where)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->select('sys_trans.*')
                ->get();
            $this->info("Memulai pengecekan. . .");
            foreach ($trans_detail as $item) {
                $difference = FunctionLib::daysBetween($item->trans_detail_transfer_date, $date, 'h');
                $this->info('Transaksi detail '.$item->trans_code.' disanggupi seller pada '.$item->trans->created_at);
                $batas = FunctionLib::get_config('transaksi_durasi_seller_tunggu');
                if($difference >= $batas){
                    // update trans detail
                    // $update = Trans_detail::findOrFail($item->id);
                    $item->trans_detail_is_cancel = 1;
                    $item->trans_detail_status = 3;
                    $item->trans_detail_able = 2;
                    $item->trans_detail_able_date = $date;
                    $item->trans_detail_able_note = 'Transaksi dibatalkan oleh sistem.';
                    $item->trans_detail_note = 'Transaksi Dibatalkan oleh sistem. Durasi tunggu seller transaksi Expired at '.$date.'.';
                    $item->save();
                    $no++;
                    $mail_send[] = $item->trans->id;

                    $this->info('transaksi '.$item->trans->trans_code.' dengan kode detail '.$item->trans_code.' expired at '.$date);
                    // update stok produk
                    $this->info("prosses mengembalikan stok produk.");
                    $item->produk->produk_stock = $item->produk->produk_stock + $item->trans_detail_qty;
                    $item->produk->save();
                    $this->info('stok produk '.$item->produk->produk_name.' ditambah '.$item->trans_detail_qty.'.');

                    // update wallet
                    $this->info("prosses pengembalian wallet ke member.");
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
                            'user_id'=>$item->trans->pembeli->id,
                            'wallet_type'=>3,
                            'amount'=>$item->trans_detail_amount_total,
                            'note'=>'Update wallet transaksi dengan transaksi detail kode '.$item->trans_code.' dan transaksi kode '.$item->trans->trans_code.'.',
                        ];
                        $saldo = FunctionLib::update_wallet($update_wallet);
                        $update_wallet = [
                            'user_id'=>2,
                            'wallet_type'=>1,
                            'amount'=>($item->trans_detail_amount_total * -1),
                            'note'=>'Update wallet CW dengan transaksi detail kode '.$item->trans_code.' dan transaksi kode '.$item->trans->trans_code.'.',
                        ];
                        $saldo = FunctionLib::update_wallet($update_wallet);
                        $this->info('Wallet transaksi '.$item->trans->pembeli->id.' ditambah sebesar '.$detail_amount_total.'.');
                    }
                }
            }
            // log cron
            $data_cron = [
                'cron_job_method' => 'trans:able',
                'cron_job_type' => 'process',
                'cron_job_status' => 1,
                'cron_job_title' => 'Transaksi Tunggu Seller',
                'cron_job_note' => $no.' transaksi berhasil dirubah menjadi expired.'
            ];
            FunctionLib::add_cron($data_cron);
            if($trans->count()){
                $this->info("mengirim email ke seller dan member.");
                foreach ($trans as $items) {
                    if (in_array($items->id, $mail_send, TRUE)){
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
                        $config = [
                            'to' => $items->pembeli->email,
                            'data' => [
                                'trans_code' => $items->trans_code,
                                'trans_amount_total' => $items->trans_amount_total,
                                'status' => $send_status,
                            ]
                        ];
                        $send_notif = FunctionLib::transaction_notif($config);
                        $this->info("berhasil mengirim email ke ".$items->pembeli->email.".");
                    }else{
                        $this->info("Tidak ada email yang dikirim.");
                    }
                }
            }
        }else{
            // log cron
            $data_cron = [
                'cron_job_method' => 'trans:able',
                'cron_job_type' => 'process',
                'cron_job_status' => 1,
                'cron_job_title' => 'Transaksi Tunggu Seller',
                'cron_job_note' => 'Tidak ada transaksi yang dirubah.'
            ];
            FunctionLib::add_cron($data_cron);

            $this->info("Data tidak ada.");
        }
        // log cron
        $data_cron = [
            'cron_job_method' => 'trans:able',
            'cron_job_type' => 'end',
            'cron_job_status' => 1,
            'cron_job_title' => 'Transaksi Tunggu Seller',
            'cron_job_note' => 'mengecek transaksi menunggu kesanggupan seller berakhir.'
        ];
        FunctionLib::add_cron($data_cron);
        $this->info($no." Transaksi Expired.");
    }
}
