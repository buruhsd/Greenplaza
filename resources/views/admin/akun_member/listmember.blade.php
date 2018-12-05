@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form action="#" method="GET">
                            <div class="input-group pull-right" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>User Store</th>
                                    <th>User Store Image</th>
                                    <th>User Slogan</th>
                                    <th>User Slug</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($users as $key => $u)
                            <tbody>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$u->username}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->user_store}}</td>
                                    <td>{{$u->user_store_image}}</td>
                                    <td>{{$u->user_slogan}}</td>
                                    <td>{{$u->user_slug}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>
                                        <a href="{{route('admin.user.editmember', $u->id)}}"><button type="submit" class="btn btn-primary">Edit</button></a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {{$users->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection