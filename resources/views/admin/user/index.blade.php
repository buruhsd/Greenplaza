@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration User</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" class="form-control" placeholder="username" name="username" value="{!! (!empty($_GET['username']))?$_GET['username']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        <option value="wait" {!! (!empty($_GET['status']) && $_GET['status'] == "wait")?"selected":"" !!}>Wait</option>
                        <option value="active" {!! (!empty($_GET['status']) && $_GET['status'] == "active")?"selected":"" !!}>Active</option>
                        <option value="block" {!! (!empty($_GET['status']) && $_GET['status'] == "block")?"selected":"" !!}>Block</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">User</h4>
                    <button type="button" onclick="search('active');" class="btn btn-info">Active<span class="label label-default pull-right">{{FunctionLib::count_user(1)}}</span></button>
                    <button type="button" onclick="search('wait');" class="btn btn-info">Wait<span class="label label-default pull-right">{{FunctionLib::count_user(0)}}</span></button>
                    <button type="button" onclick="search('block');" class="btn btn-info">Block<span class="label label-default pull-right">{{FunctionLib::count_user(2)}}</span></button>
                    <a href="{{ url('admin/user/create') }}" class="btn btn-success btn-sm pull-right">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto User</th>
                                    <th>Username</th>
                                    <th>Detail User</th>
                                    <th>Detail Seller</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($user as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td><img class="h100" src="{{asset("assets/images/user/".$item->user_image)}}" onerror="this.src='http://placehold.it/700x400'"></td>
                                        <th scope="row">{{$item->username}}</th>
                                        <td scope="row">
                                            <ul>
                                                <li>Name : {{$item->name}}</li>
                                                <li>Email : {{$item->email}}</li>
                                                <li>Email verified at : {{$item->email_verified_at}}</li>
                                                <li>Status Email : 
                                                    {!!($item->email_verified_at != null && $item->email_verified_at != "")
                                                        ?"<button class='btn btn-success btn-xs'>Active</button>"
                                                        :"<button class='btn btn-danger btn-xs'>Non Active</button>"!!}
                                                </li>
                                                <li><button class='btn btn-info btn-xs'>More</button></li>
                                                {{-- <li>password : {{$item->password}}</li> --}}
                                                {{-- <li>remember_token : {{$item->remember_token}}</li> --}}
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <ul>
                                                <li>Store : {{$item->Store}}</li>
                                                <li>Store image : {{$item->user_store_image}}</li>
                                                <li>Slogan : {{$item->user_slogan}}</li>
                                                <li>Slug : {{$item->user_slug}}</li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <a href="{{route('admin.user.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                            <a href="{{route('admin.user.edit', $item->id)}}" class='btn btn-info btn-xs'>Edit</a>
                                            <a href="{{route('admin.user.destroy', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        $arr_src = [
                            'name' => Request::get('name'), 
                            'username' => Request::get('username'), 
                            'status' => Request::get('status')
                        ];
                    ?>
                    <div> {!! $user->appends($arr_src)->render() !!} </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.input-tanggal').datepicker();       
    });
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
        