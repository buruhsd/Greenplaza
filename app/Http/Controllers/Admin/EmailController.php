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
        $value = $request->value;
        $email = new Email;
    
        $email->email_from = 'super admin';
        $email->email_subject = $request->email_subject;
        $email->is_send = 0;
        $email->email_text = $request->email_text;
        $email->is_send_datetime = date("d-M-Y_H-i-s");
        if($request->email_to){
            $user = User::where('email', $request->email_to)->first();
            if($user){
                $email->email_to = $request->email_to;
                $email->save();
            } else {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Email Salah"
                        ]);
                return redirect()->back();
            } 
        }
        if ($email->email_to == null && $value == 2){
            $email->email_type = 'send for allmember';
        }elseif ($email->email_to == null && $value == 3) {
            $email->email_type = 'send for allseller';
        }elseif ($email->email_to == null && $value == 4) {
            $email->email_type = 'send for all';
        }else {
                $email->email_type = 'single send';
        }
        $email->save();
        $usersall = User::whereHas('roles', function($query){
                $query->where('name','=','member');
                return $query;
            })
            ->pluck('email')->toArray();
        $usermember = User::whereHas('roles', function($query){
                $query->where('name','=','member');
                return $query;
            })
            ->where('user_store', '==', null)->pluck('email')->toArray();
        // dd($usermember);
        $userseller = User::whereHas('roles', function($query){
                $query->where('name','=','member');
                return $query;
            })
            ->where('user_store', '!=', null)->pluck('email')->toArray();

        if ($email->email_to != null) {
                               
            Mail::send('admin.mail.email_sender', compact(['email', 'user', 'users']), function ($m) use ($email) {
                $m->to($email->email_to, $email->email_to)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Sending to " .$email->email_to
                    ]);
        } elseif ($email->email_to == null && $value == 2) {
            Mail::send('admin.mail.email_sender', compact(['email', 'usermember']), function ($m) use ($usermember) {
                $m->to($usermember, $usermember)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All Member"
                    ]);
        } elseif ($email->email_to == null && $value == 3) {
            Mail::send('admin.mail.email_sender', compact(['email', 'userseller']), function ($m) use ($userseller) {
                $m->to($userseller, $userseller)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All Seller"
                    ]);
        } elseif ($email->email_to == null && $value == 4) {
            Mail::send('admin.mail.email_sender', compact(['email', 'usersall']), function ($m) use ($usersall) {
                $m->to($usersall, $usersall)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All Member and Seller"
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
            Mail::send('admin.mail.email_sender', compact(['email', 'users']), function ($m) use ($email) {
                $m->to($email->email_to, $email->email_to)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Sending to " .$email->email_to
                    ]);
        } else {
            $email = Email::find($id);
            $email->is_send = 1;
            $email->save();
            Mail::send('admin.mail.email_sender', compact(['email', 'users']), function ($m) use ($users) {
                $m->to($users, $users)->subject('GreenPlaza');
            });
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Email Send for All"
                    ]);
        }
        return redirect()->back();

    }

}
