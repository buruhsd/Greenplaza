@extends('admin.index')
@section('content')

<div class="page-title">
</div>
<div class="col-md-12">
    <div class="panel-body">
    	<div class="panel panel-white">
            <div class="panel-heading clearfix">
            	<div class="col-md-6">
                <h4 class="panel-title">Page Add</h4>
            	</div>
            	<div class="col-md-6">
            		<a href="{{route('admin.page_list')}}"><button type="" class="btn btn-default pull-right">List Page</button></a>
            	</div>
            </div>
            @include('layouts._flash')
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action= "{{route('admin.page_add')}}" enctype = "multipart/form-data">
                	{{ csrf_field() }}
                    <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Judul</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="page_judul" placeholder="" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Role_id</label>
                        <div class="col-sm-10">
                            <select id="" type="text" name="page_role_id" class="form-control">
                            	<option value="">--Select Role--</option>
                            	<option value="2">Admin</option>
                            	<option value="3">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Kategori</label>
                        <div class="col-sm-10">
                            <select id="" type="text" name="page_kategori" class="form-control">
                            	<option value="">--Select Kategori--</option>
                            	<option value="ADMIN">ADMIN</option>
                            	<option value="MEMBER">MEMBER</option>
                            	<option value="GREENPLAZA">GREENPLAZA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Text</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="page_text" placeholder="" rows="10"></textarea>
                        </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Submit</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection