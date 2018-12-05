<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Email;
use App\User;
use Session;
use Mail;

class EmailController extends Controller
{
    public function email (Request $request)
    {
    	$email = new Email;
    	$email->email_to = $request->email_to;
    	$email->email_from = 'super admin';
    	$email->email_subject = $request->email_subject;
    	$email->is_send = 0;
    	$email->email_text = $request->email_text;
    	if ($email->email_to == null){
    		$email->email_type = 'send for all';
    	} else {
    		$email->email_type = 'single send';
    	}
    	$email->is_send_datetime = date("d-M-Y_H-i-s");
    	$email->save();

    	$user = User::find($email->email_to);
    	$users = User::pluck('email')->toArray();
    	// dd($users);
    	if ($email->email_to != null) {
                               
            Mail::send('admin.mail.tes', compact(['email', 'user', 'users']), function ($m) use ($email) {
                $m->to($email->email_to, $email->email_to)->subject('tes');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Sending to " .$email->email_to
                    ]);
        } else {
        	Mail::send('admin.mail.tes', compact(['email', 'users', 'user']), function ($m) use ($users) {
                $m->to($users, $users)->subject('tes');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All"
                    ]);
        }
    	return redirect()->back();
    }

    public function list_email ()
    {
        $search = \Request::get('search');
    	$email = Email::where('email_subject', 'like', '%'.$search.'%')
                ->orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.email-sender.email_list', compact('email'));
    }

    public function delete($id) 
    {
        $email = Email::find($id);
        $email->delete();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Data Email di Hapus"
            ]);
        return redirect()->back();
    }

    public function resend (Request $request, $id)
    {
        $users = User::pluck('email')->toArray();
        $email = Email::find($id);
        // dd($email);

        if ($email->email_to != null) {
            $email = Email::find($id);
            $email->is_send = 1;
            $email->save(); 
            Mail::send('admin.mail.tes', compact(['email', 'users']), function ($m) use ($email) {
                $m->to($email->email_to, $email->email_to)->subject('tes');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Sending to " .$email->email_to
                    ]);
        } else {
            $email = Email::find($id);
            $email->is_send = 1;
            $email->save();
            Mail::send('admin.mail.tes', compact(['email', 'users']), function ($m) use ($users) {
                $m->to($users, $users)->subject('tes');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All"
                    ]);
        }
        return redirect()->back();

    }

}
