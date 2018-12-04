@extends('admin.index')
@section('content')

@include('layouts._flash')
<div class="col-md-12">
    <div class="panel-body">
    	<div class="col-md-12">
            <div class="panel panel-white">
            	<div class="col-md-6">
	                <a href="{{route('admin.page')}}"><button type="" class="btn btn-default">Kembali</button></a>
	            </div>
	            <div class="col-md-6">
	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                  	<form action="#" method="GET">
		                    <div class="input-group pull-right" style="width: 225px;">
		                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
		                        <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Page Judul ..."></a>
		                    </div>
	                  	</form>
	              	</div>
	            </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Created_at</th>
                                <th>Page Judul</th>
                                <th>Page Role_id</th>
                                <th>Page Kategori</th>
                                <th>Page Text</th>
                                <th>Page Status</th>
                                <th>Page Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($page as $p)
                        <tbody>
                            <tr>
                                <td>{{$p->created_at}}</td>
                                <td>{{$p->page_judul}}</td>
                                @if ($p->page_role_id == 2)
                                <td>Admin</td>
                                @else
                                <td>Member</td>
                                @endif
                                <td>{{$p->page_kategori}}</td>
                                <td>{{$p->page_text}}</td>
                                @if ($p->page_status == 1)
                                <td>Page Dimunculkan</td>
                                @else
                                <td>Page Hidden</td>
                                @endif
                                <td>{{$p->page_slug}}</td>
                                <td>
                                    <a href="{{route('admin.delete_page', $p->id)}}"><button type="" class="btn btn-danger btn-rounded">Delete</button></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    {{$page->render()}}
                </div>
            </div>
         </div>
    </div>
</div>

@endsection