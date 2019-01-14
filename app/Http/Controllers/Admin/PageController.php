<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Session;


class PageController extends Controller
{
    public function page ()
    {
    	return view('admin.page.page');
    }

    public function page_add (Request $request)
    {
    	$this->validate($request, [
            'page_judul' => 'required|string',
            'page_role_id' => 'required|string',
            'page_kategori' => 'required|string', 
            'page_text' => 'required|string', 
        ]);

    	$page = new Page;
    	$page->page_judul = $request->page_judul;
    	$page->page_role_id = $request->page_role_id;
    	$page->page_kategori = $request->page_kategori;
    	$page->page_text = $request->page_text;
    	$page->page_slug = str_slug($page->page_judul, "-");
    	$page->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Page Tersimpan"
                    ]);

    	return redirect()->back();

    }

    public function page_list ()
    {
    	$search = \Request::get('search');
    	$page = Page::where('page_judul', 'like', '%'.$search.'%')
                ->orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.page.list_page', compact('page'));
    }

    public function delete($id) 
    {
        $page = Page::find($id);
        $page->delete();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Data Page di Hapus"
            ]);
        return redirect()->back();
    }
}
