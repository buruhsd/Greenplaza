<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckMail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = 500;
        $message = "Email Not Activate, Please check your email.";
        // get mail
        // $mail = $request->user()->email;
        // Check if a email is activate.
        if ($request->user()->is_verify()) {
            return $next($request);
        }
        Auth::logout();
        return redirect('login')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }
}
