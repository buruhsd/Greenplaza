<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\User;
use Session;
use Mail;

class WithdrawalController extends Controller
{
    public function withdrawal_member ()
    {
    	$search = \Request::get('search');
        $with = Withdrawal::where('withdrawal_user_id', 'like', '%'.$search.'%')
                ->orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.withdrawal.withdrawal_member', compact('with'));
    }

    public function approve (Request $request, $id) 
    {
    	$with = Withdrawal::find($id);
    	$with->withdrawal_status = 1;
    	$with->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Withdraw Approved"
                    ]);
    	return redirect()->back(); 
    }
    public function reject (Request $request, $id) 
    {
    	$comment = $request->comment;
    	$with = Withdrawal::find($id);
    	$with->withdrawal_status = 2;
    	$with->save();
    	$users = User::where('id', $with->withdrawal_user_id)->first();
    	Mail::send('admin.mail.withdrawal_ditolak', compact('users', 'comment'), function ($m) use ($users, $comment) {
                $m->to($users->email, $users->name)->subject('Withdrawal Member Ditolak');
                Session::flash("flash_notification", [
                    "level" => "warning",
                    "message" => "Data Ditolak"
                ]);
            });
    	return redirect()->back(); 
    }
}
