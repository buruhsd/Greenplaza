<?php

namespace App\Facades\Classes;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Mail;


class SendEmail extends Controller
{
	public function basic($param=[]) {
   		$name = env('MAIL_FROM_NAME', 'Admin GreenPlaza');
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'basic';
		extract($param);

		$data = array('name'=>$name);
		Mail::send(['text'=>$view], $data, function($message) use ($to, $from, $subject) {
			$message->to($to)
				->subject($subject);
			$message->from($from);
		});
   }

   public function html($param=[]) {
   		$name = env('MAIL_FROM_NAME', 'Admin GreenPlaza');
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'email.html';
		extract($param);

		$data = array('name'=>$name);
		Mail::send($view, $data, function($message) use ($to, $from, $subject) {
			$message->to($to)
				->subject($subject);
			$message->from($from);
		});
		echo 'sip';
   }

   public function attach($param=[]) {
   		$name = env('MAIL_FROM_NAME', 'Admin GreenPlaza');
   		$from = env('MAIL_USERNAME', 'GreenPlaza@greenplaza.me');
   		$to = $from;
   		$subject = 'Notifikasi GreenPlaza';
   		$view = 'attach';
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
