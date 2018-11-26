<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Conf_config;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class Conf_configController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_configs';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = FunctionLib::config_arr('profil');
        dd(Conf_config::whereIn('configs_name', $arr)->get());
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['config'] = Conf_config::where('configs_status', 'LIKE', "%$keyword%")
                ->orWhere('configs_name', 'LIKE', "%$keyword%")
                ->orWhere('configs_value', 'LIKE', "%$keyword%")
                ->orWhere('configs_note', 'LIKE', "%$keyword%")
                ->paginate($this->perPage);
        } else {
            $data['config'] = Conf_config::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('superadmin.config.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Config added!';
        $this->validate($request, [
			'configs_name' => 'required',
			'configs_value' => 'required'
		]);
        $requestData = $request->all();
        
        $res = Conf_config::create($requestData);
        if(!$res){
            $status = 500;
            $message = 'Config Not added!';
        }
        if($request->ajax()){
            return response()->json(['flash_status'=>$status, 'flash_message'=>$message]);
        }
        return redirect('superadmin/conf_config')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['conf_config'] = Conf_config::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['conf_config'] = Conf_config::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Config Updated!';
        $this->validate($request, [
			'configs_name' => 'required',
			'configs_value' => 'required'
		]);
        $requestData = $request->all();
        
        $conf_config = Conf_config::findOrFail($id);
        $res = $conf_config->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Config Not updated!';
        }

        if($request->ajax()){
            return response()->json(['flash_status'=>$status, 'flash_message'=>$message]);
        }
        return redirect('superadmin/config')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $status = 200;
        $message = 'conf_config deleted!';
        $res = Conf_config::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'conf_config Not deleted!';
        }

        return redirect('superadmin/config')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $where
    * @return
    */
    public function get_one_row($where='1', $join=array()){
        $qry = 'SELECT * FROM '.$this->mainTable;
        if(!empty($join)){
            foreach ($join as $value) {
                $qry .= $value;
            }
        }
        $qry .= ' WHERE '.$where.' Limit 1';
        $conf_config = DB::query($qry);

        return $conf_config;
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function footer_script($method=''){
        ob_start();
        ?>
            <script type="text/javascript"></script>
        <?php
        switch ($method) {
            case 'index':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'create':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
