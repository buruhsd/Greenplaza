<?php

namespace App\Console\Commands;

use App\MOdels\Trans;
use App\MOdels\Trans_detail;
use App\MOdels\Wallet;
use Illuminate\Console\Command;

class CronTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengecek transaksi done tanpa dropping.';

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
        $where .= ' AND trans_detail_no_resi != 0';
        $where .= ' AND trans_detail_status = 5';
        $where .= ' AND trans_detail_is_cancel = 0';
        $trans_detail = Trans_detail::whereRaw($where)->get();
        foreach ($trans_detail as $item) {
            // update trans detail
            $update = Trans_detail::findOrFail($item->id);
            $update->trans_detail_drop = 1;
            $update->trans_detail_drop_date = $date;
            $update->trans_detail_drop_note = 'Transaktion dropping by system.';
            $update->trans_detail_note = $update->trans_detail_note.' Transaktion dropping by system at '.$date.'.';
            $update->save();
            // update wallet
            $where = '1';
            $where .= ' AND wallet_user_id = '.$item->trans->trans_user_id;
            $where .= ' AND wallet_type = 3';
            $wallet = Wallet::whereRaw($where)->first();
            $wallet->wallet_ballance_before = $wallet->wallet_ballance;
            $wallet->wallet_ballance = $wallet->wallet_ballance + $item->trans_detail_amount_total;
            $wallet->wallet_note = 'Updated by system.';
            $wallet->save();
        }
    }
}
