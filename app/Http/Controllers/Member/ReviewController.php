<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Bank;
use App\Models\Review;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use \Validator;


class ReviewController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_bank';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['bank'] = Review::paginate($this->perPage);
        } else {
            $data['bank'] = Review::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.review.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.review.create', $data);
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
        $message = 'Review added!';
        
        $requestData = $request->all();
        $validator = Validator::make($request->all(), [
            'stars' => 'required',
            'review_text' => 'required',
        ]);
        if ($validator->fails()) {
            $status = 500;
            $message = "isikan komentar anda.";
            return back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }

        $res = new Review;
        $res->review_produk_id = $request->review_produk_id;
        $res->review_user_id = $request->review_user_id;
        // $res->review_stars = $request->stars;
        $res->review_text = $request->review_text;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Review Not added!';
        }
        return redirect()->back()
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
        $data['bank'] = Review::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.review.show', $data);
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
        $data['bank'] = Review::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.review.edit', $data);
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
        $message = 'Review added!';
        
        $requestData = $request->all();
        
        $bank = Review::findOrFail($id);
        $bank->bank_kode = $request->bank_kode;
        $bank->bank_name = $request->bank_name;
        $bank->bank_note = $request->bank_note;
        $bank->save();
        $res = $bank->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Review Not updated!';
        }

        return redirect()->back()
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
        $message = 'Review deleted!';
        $res = Review::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Review Not deleted!';
        }

        return redirect('member/Review')
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
        $bank = DB::query($qry);

        return $bank;
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
                    <!-- <link href="<?php //echo asset('xtreme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet"> -->
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
