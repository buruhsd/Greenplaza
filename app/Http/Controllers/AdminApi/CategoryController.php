<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_category';

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        if (!empty($keyword)) {
            $data['category'] = Category::where('category_name', 'like',$keyword."%")->paginate($this->perPage);
        } else {
            $data['category'] = Category::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);	
    }
   public function store(Request $request)
    {
        $status = 200;
        $message = 'Category added!';
        $success = true;
        
        $requestData = $request->all();
        
        $res = new Category;
        $res->category_parent_id = $request->category_parent_id;
        $res->category_name = $request->category_name;
        $res->category_note = $request->category_note;
       	$res->save();
        if(!$res){
            $status = 500;
            $message = 'Category Not added!';
            $success = false;
        }
        return response()->json(['success' => $success, 'message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['category'] = Category::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);	
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Category updated!';
        $success = true;
        
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->category_parent_id = $request->category_parent_id;
        $category->category_name = $request->category_name;
        $category->category_note = $request->category_note;
       	$category->save();
        $res = $category->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Category Not updated!';
            $success = false;
        }
        return response()->json(['success' => $success, 'message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Category deleted!';
        $success = true;
        $res = Category::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Category Not deleted!';
            $success = false;
        }
        return response()->json(['success' => $success, 'message'=>$message, 'status'=>$status]);
    }

}
