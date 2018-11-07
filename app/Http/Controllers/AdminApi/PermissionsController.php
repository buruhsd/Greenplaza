<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionsController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'activity_log';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        
            $data['permissions'] = Permission::all();

        return response()->json(['success' => true, 'data'=>$data]);
    }
}
