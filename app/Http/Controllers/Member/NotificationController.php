<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Notification;
use Redirect;

class NotificationController extends Controller
{
    /**
     * Update data bank user.
     * @param  $request
     * @param  int  $id
     * @return redirect bank user.
     */
    public function is_read($id)
    {
        $date = date('Y-m-d H:i:s');
        $res = Notification::findOrFail($id);
        $res->read_at = $date;
        $res->save();
        $data = json_decode($res->data, true);
        return Redirect::to($data['data']['route']);
    }
}
