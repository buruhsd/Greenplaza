<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class CategoryController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index_json (Request $request)
    {
        $columns = array( 
            0 => 'id',
            1 => 'id2',
            2 => 'category_name',
            3 => 'id3',
            4 => 'id4',
            5 => 'position',
            6 => 'category_note',
            7 => 'id5',
        );
    
        $arr_order = [
            'id'=> 'id',
            'id2'=> 'id',
            'category_name'=> 'category_name',
            'id3'=> 'id',
            'id4'=> 'id',
            'position'=> 'position',
            'category_note'=> 'category_note',
            'id5'=> 'id',
        ];

        $totalData = Category::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $arr_order[$columns[$request->input('order.0.column')]];
        // $order = ($columns[$request->input('order.0.column')] == 'no')
        //     ?'sys_trans.id'
        //     :($columns[$request->input('order.0.column')] == 'option')
        //         ?'sys_trans.id'
        //         :$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $from = date('Y-m-d'. ' 00:00:00',strtotime("-7 days"));
        $to = date('Y-m-d'. ' 23:59:59');
        $search = empty($request->input('search.value'))?null:$request->input('search.value'); 
        $from = empty($request->input('dt_from'))?$from:date($request->input('dt_from'). ' 00:00:00', time());
        $to = empty($request->input('dt_to'))?$to:date($request->input('dt_to'). ' 23:59:59', time());
        $voucher = empty($request->input('dt_voucher'))?'':$request->input('dt_voucher');
        $status = empty($request->input('dt_status'))?0:$request->input('dt_status'); 
        $method = empty($request->input('dt_method'))?0:$request->input('dt_method'); 

        $posts =  Category::offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
                    // dd($posts);
        $totalFiltered = Category::count();

        $data = array();
        if(!empty($posts))
        {
            $no = 1;
            foreach ($posts as $post)
            {
                // $nestedData['no'] = $no++;
                $nestedData['id'] = $post->id;
                $nestedData['id2'] = ($post->par['category_name'])
                                    ?$post->par['category_name']
                                    :"<button class='btn btn-danger btn-xs'>On Top</button>";
                $nestedData['category_name'] = $post->category_name;
                $nestedData['id3'] = ($post->category_parent_id == 0)
                                    ?"Parent Category"
                                    :"Child Category";
                $nestedData['id4'] = ($post->category_status == 1)
                                    ?"<button class='btn btn-success btn-xs'>Active</button>"
                                    :"<button class='btn btn-danger btn-xs'>Not Active</button>";
                $nestedData['position'] = $post->position;
                $nestedData['category_note'] = $post->category_note;
                $nestedData['id5'] = "<a href='".url('/admin/category/show', ['id' => $post->id])."'>
                                        <button class='btn btn-info btn-xs'>
                                                <i class='fa fa-eye' aria-hidden='true'></i>View
                                        </button></a>
                                        <a href='".url('/admin/category/edit', ['id' => $post->id])."'>
                                        <button class='btn btn-warning btn-xs'>
                                            <i class='fa fa-edit' aria-hidden='true'></i>Edit
                                        </button></a>
                                        <button class='btn btn-danger btn-xs' onclick='modal_get($(this));dts.ajax.reload();Swal.fire(".'"Delete Success"'.");' data-href='".route('admin.category.destroy', ['id' => $post->id])."' data-toggle='modal' data-method='get'>
                                            <i class='fa fa-edit' aria-hidden='true'></i>Delete
                                        </button>";
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
            );
            
        echo json_encode($json_data);
    }
    public function index(Request $request)
    {
        // $keyword = $request->get('search');

        // if (!empty($keyword)) {
        //     $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        // } else {
        //     $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        // }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.category.index', $data);
    }
    public function indexparent (Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->where('category_parent_id', '=', 0)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        } else {
            $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->where('category_parent_id', '=', 0)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.category.indexparent', $data);
    }
    public function indexchild(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->where('category_parent_id', '!=', 0)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        } else {
            $data['category'] = Category::where('position', 'like', '%'.$keyword.'%')->where('category_parent_id', '!=', 0)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.category.indexchild', $data);
    }

    // public function try (Request $request, $id)
    // {
    //     $category = Category::find($id);
    //     $category->category_parent_id = $request->category_parent_id;
    //     $category->category_name = $request->category_name;
    //     $category->category_note = $request->category_note;
    //     $category->save();
    //     if ($request->position){
    //         // Determine if the user is moving the item up or down in the listing
    //         $move = $category->position > $request->position ? 'down' : 'up';
    //         // Set the display_order for the dragged item to be 0 so we can update this record later by display_order = 0
    //         $category = "UPDATE todos
    //                   SET $category->position = 0
    //                   WHERE $category->position = :$category->position
    //                   AND $category->position = :$category->position";
    //         // Move down: Update the items between the current position and the desired position, decreasing each item by 1 to make space for the new item
    //         if ($move == 'down') {
    //             $category = "UPDATE todos
    //                       SET $category->position = ($category->position - 1)
    //                       WHERE $category->position > :$category->position
    //                       AND $category->position <= :$request->position
    //                       AND $category->position = :$category->position";
    //         }
    //         // Move up: Update the items between the desired position and the current position, increasing each item by 1 to make space for the new item
    //         elseif ($move == 'up') {
    //             $category = "UPDATE todos
    //                       SET $category->position = ($category->position + 1)
    //                       WHERE $category->position >= :$request->position
    //                       AND $category->position < :$category->position
    //                       AND $category->position = :$category->position";
    //         }
    //         // Update the item that was dragged and set it to be the desired position now that the slot is opend up
    //         $category = "UPDATE todos
    //                   SET $category->position = :$request->position
    //                   WHERE $category->position = 0
    //                   AND $category->position = :$category->position";
    //     }
    //     $category->save();
    //     return redirect()->back(); 
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['category_par'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.create', $data);
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
        $message = 'Category added!';
        
        $requestData = $request->all();
        $this->validate($request, [
            // 'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_name' => 'required',
        ]);
        
        $res = new Category;
        $res->category_parent_id = $request->category_parent_id;
        $res->category_name = $request->category_name;
        // upload
        if ($request->hasFile('category_icon')){
            $icon = $request->file('category_icon');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('img_category_icon');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $iconname = FunctionLib::str_rand(5).'.'.$icon->getClientOriginalExtension();
            $iconsize = $icon->getClientSize();
            $icontmp = $icon->getPathName();
            if(file_exists($uploadPath . '/' . $iconname)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $iconname = FunctionLib::str_rand(6).'.'.$icon->getClientOriginalExtension();
            }
            $icon->move($uploadPath, $iconname);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->category_icon = $iconname;
        }
        // upload
        if ($request->hasFile('category_image')){
            $image = $request->file('category_image');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('assets/images/category_image');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $imagename = FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetmp = $image->getPathName();
            if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $imagename = FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
            }
            $image->move($uploadPath, $imagename);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->category_image = $imagename;
        }

        if ($request->position)
        {
            $res->position = $request->position;
            $res->save();
        } else {
            $category = Category::orderBy('position', 'DESC')->first();
            $res->position = ($category->position) + 1;
            $res->save();
        }

        if ($request->category_name)
        {
            $category = Category::where('category_name', $request->category_name)->first();
            if ($category){
                $res->category_slug = str_slug($request->category_name)."-".Auth::User()->name;
                $res->save();
            } else{
                $res->category_slug = str_slug($request->category_name);
                $res->save();
            }
        }
        
        
        $res->category_note = $request->category_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Category Not added!';
        }
        return redirect('admin/category')
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
        $data['category'] = Category::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.show', $data);
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
        $data['category_par'] = Category::all();
        $data['category'] = Category::findOrFail($id);
        
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.edit', $data);
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
        $message = 'Category added!';
        
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->category_parent_id = $request->category_parent_id;
        $category->category_name = $request->category_name;
        $category->category_note = $request->category_note;
        $category->position = $request->position;
        $category->save();
        $res = $category->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Category Not updated!';
        }

        return redirect('admin/category')
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
        $uploadPath = public_path('img_category_icon');
        $icon = Category::where('id', '=', "$id")->pluck('category_icon')[0];
        $uploadPath2 = public_path('assets/images/category_image');
        $image = Category::where('id', '=', "$id")->pluck('category_image')[0];

        $status = 200;
        $message = 'Category deleted!';
        $res = Category::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Category Not deleted!';

            $icon_path = $uploadPath . '/' . $icon;  // Value is not URL but directory file path
            $image_path = $uploadPath2 . '/' . $image;  // Value is not URL but directory file path
            if(File::exists($icon_path)) {
                File::delete($icon_path);
            }
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return redirect('admin/category')
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
        $category = DB::query($qry);

        return $category;
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
                    <link href="<?php echo asset('admin/datatables/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
                    <script src="<?php echo asset('admin/datatables/extra-libs/DataTables/datatables.min.js') ?>"></script>
                    <script type="text/javascript">

                    var dts = $('#scroll_hor').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "filter": false,
                        "dom": "<'row'<'col-sm-12 col-md-6'f>"+
                                    "<'col-sm-12 col-md-6 justify-content-end'"+
                                            "<'d-flex no-block justify-content-end align-items-center'l>>>" +
                                "<'row'<'col-sm-12 text-center'tr>>" +
                                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "ajax":{
                            "url": "<?php echo route("admin.category.index_json") ?>",
                            "dataType": "json",
                            "type": "POST",
                            "data":function(d){
                                d._token = "<?php echo csrf_token()?>";

                            }
                        },
                        "columns": [
                            { "data": 'id' },
                            { "data": 'id2' },
                            { "data": 'category_name' },
                            { "data": 'id3' },
                            { "data": 'id4' },
                            { "data": 'position' },
                            { "data": 'category_note' },
                            { "data": 'id5' },
                        ]
                    });
                    </script>
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
