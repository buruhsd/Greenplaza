<?php

namespace App\Facades\Classes;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;


class SendEmail extends Controller
{
	public function basic($param=[]) {
   		$name = env('MAIL_FROM_NAME', 'Admin GreenPlaza');
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'email.basic';
		extract($param);

		$data = array('name'=>$name);
		Mail::send(['text'=>$view], $data, function($message) use ($to, $from, $subject) {
			$message->to($to)
				->subject($subject);
			$message->from($from);
		});
   }

   public function html($param=[]) {
	   	$name = ['name' => env('MAIL_FROM_NAME', 'Admin GreenPlaza')];
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'email.html';
		extract($param);
		if(isset($data)){
			$data = array_merge($data, $name);
		}else{
			$data = $name;
		}
		// dd($to, $from, $subject, $data);
		Mail::send($view, $data, function($message) use ($to, $from, $subject) {
			$message->from($from);
			$message->to($to)
				->subject($subject);
		});
		$html = view($view, $data)->render();
		$email = new Email;
		$email->email_to = $to;
		$email->email_from = $from;
		$email->email_subject = $subject;
		$email->email_text = $html;
		$email->save();
   }

   public function attach($param=[]) {
   		$name = env('MAIL_FROM_NAME', 'Admin GreenPlaza');
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'email.attach';
   		$attach = [];
		extract($param);

		$data = array('name'=>$name);
		Mail::send($view, $data, function($message) use ($to, $from, $subject, $attach) {
			$message->to($to)
				->subject($subject);
			if(isset($attach) && !empty($attach)){
				foreach ($attach as $item) {
					$message->attach($item);
				}
			}
			$message->from($from);
		});
   }
}
