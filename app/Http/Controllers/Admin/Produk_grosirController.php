<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk_grosir;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class Produk_grosirController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk_grosir';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['produk_grosir'] = Produk_grosir::paginate($this->perPage);
        } else {
            $data['produk_grosir'] = Produk_grosir::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.produk_grosir.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.produk_grosir.create', $data);
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
        $message = 'Produk_grosir added!';
        
        $requestData = $request->all();
        
        $res = new Produk_grosir;
        $res->produk_grosir_produk_id = $request->produk_grosir_produk_id;
        $res->produk_grosir_start = $request->produk_grosir_start;
        $res->produk_grosir_end = $request->produk_grosir_end;
        $res->produk_grosir_price = $request->produk_grosir_price;
        $res->produk_grosir_note = $request->produk_grosir_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not added!';
        }
        return redirect('admin/produk_grosir')
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
        $data['produk_grosir'] = Produk_grosir::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.produk_grosir.show', $data);
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
        $data['produk_grosir'] = Produk_grosir::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.produk_grosir.edit', $data);
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
        $message = 'Produk_grosir added!';
        
        $requestData = $request->all();
        
        $produk_grosir = Produk_grosir::findOrFail($id);
        $produk_grosir = Produk_grosir::findOrFail($id);
        $produk_grosir->produk_grosir_produk_id = $request->produk_grosir_produk_id;
        $produk_grosir->produk_grosir_start = $request->produk_grosir_start;
        $produk_grosir->produk_grosir_end = $request->produk_grosir_end;
        $produk_grosir->produk_grosir_price = $request->produk_grosir_price;
        $produk_grosir->produk_grosir_note = $request->produk_grosir_note;
        $produk_grosir->save();
        $res = $produk_grosir->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not updated!';
        }

        return redirect('admin/produk_grosir')
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
        $message = 'Produk_grosir deleted!';
        $res = Produk_grosir::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not deleted!';
        }

        return redirect('admin/produk_grosir')
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
        $produk_grosir = DB::query($qry);

        return $produk_grosir;
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
