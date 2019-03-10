<?php
namespace App\Observers;
use App\Models\Wallet_type;
use App\Models\Wallet;
use App\User;
class WalletRegisterUserObserver
{
    //listen to creating config
    public function created(User $item)
    {
        $this->setLog("created", $item);
    }
    private function setLog($type, $item)
    {
        $wallet_type = Wallet_type::where('id', '!=', 7)->get();
        // dd($wallet_type);
        foreach ($wallet_type as $wallet) {
            $log = [
                'wallet_user_id' => $item->id,
                'wallet_type' => $wallet->id, 
                'wallet_ballance_before' => 0,
                'wallet_ballance' => 0,
                // 'wallet_address' => $item->wallet_address,
                // 'wallet_public' => $item->wallet_public,
                // 'wallet_private' => $item->wallet_private,
                'wallet_note' => "Created by registration"
            ];
            Wallet::create($log);
        }
    }
}