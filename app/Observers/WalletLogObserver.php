<?php
namespace App\Observers;
use App\Models\Log_wallet;
use App\Models\Wallet;
use Auth;
class WalletLogObserver
{
    //listen to creating config
    public function created(Wallet $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Wallet $item)
    {
        $this->setLog("updated", $item);
    }
    public function deleted(Wallet $item)
    {
        $this->setLog("deleted", $item);
    }
    public function restored(Wallet $item)
    {
        $this->setLog("restored", $item);
    }
    private function setLog($type, $item)
    {
        $wallet_cash_in = ($item->wallet_ballance_before <= $item->wallet_ballance)
            ?($item->wallet_ballance - $item->wallet_ballance_before)
            :0;
        $wallet_cash_out = ($item->wallet_ballance <= $item->wallet_ballance_before)
            ?($item->wallet_ballance_before - $item->wallet_ballance)
            :0;
        switch ($type) {
            case 'created':
                $wallet_note = 'Created Wallet';
            break;
            case 'updated':
                $wallet_note = ($wallet_cash_in > 0)
                    ?"penambahan saldo ".$item->type->wallet_type_name." sebesar ".$wallet_cash_in
                    :"pengurangan saldo ".$item->type->wallet_type_name." sebesar ".$wallet_cash_out;
            break;
            case 'deleted':
                $wallet_note = 'Deleted Wallet';
            break;
            case 'restored':
                $wallet_note = 'Restored Wallet';
            break;
            default:
                # code...
                break;
        }
        $wallet_note = (isset($item->wallet_note) && $item->wallet_note != null && $item->wallet_note != "")
            ?$item->wallet_note
            :$wallet_note;
        $log = [
            'wallet_type_log'=> $type, 
            'wallet_type'=> $item->wallet_type, 
            'wallet_user_id'=> $item->wallet_user_id, 
            'wallet_user_name'=> $item->wallet_user_name, 
            'wallet_ballance_before'=> $item->wallet_ballance_before, 
            'wallet_ballance_after'=> $item->wallet_ballance, 
            'wallet_cash_in'=> $wallet_cash_in, 
            'wallet_cash_out'=> $wallet_cash_out, 
            // 'wallet_user_from'=> $item->wallet_user_from, 
            // 'wallet_user_from_name'=> $item->wallet_user_from_name, 
            'wallet_note'=> $wallet_note, 
            // 'wallet_pajak'=> $item->wallet_pajak, 
            // 'wallet_id_grade_pajak'=> $item->wallet_id_grade_pajak, 
            // 'wallet_id_referensi'=> $item->wallet_id_referensi, 
        ];
        Log_wallet::create($log);
    }
}