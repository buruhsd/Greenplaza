@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Brand</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Tanggal</label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="Tanggal Checkout">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Mulai</label>
                    <input type="text" class="form-control input-tanggal" id="inputPassword2" placeholder="Mulai">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Sampai dengan:</label>
                    <input type="text" class="form-control input-tanggal" id="inputPassword2" placeholder="Sampai dengan">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Configuration Brand</h4>
                    <a href="{{ url('admin/brand/create') }}" class="btn btn-success btn-sm pull-right">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>User</th>
                                    <th>Detail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brand as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img class="h100" src="{{asset("assets/images/brand/".$item->brand_image)}}"></td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td scope="row">
                                            <ul>
                                                <?php 
                                                switch ($item->brand_user_status) {
                                                    case 3:
                                                        $users = FunctionLib::data_user_by_id($item->brand_seller_id);
                                                        break;
                                                    case 2:
                                                        $users = FunctionLib::data_user_by_id($item->brand_admin_id);
                                                        break;
                                                    case 1:
                                                        $users = FunctionLib::data_user_by_id($item->brand_superadmin_id);
                                                        break;
                                                    default:
                                                        break;
                                                }
                                                ?>
                                                <li>window : {{$item['user_store']}}</li>
                                                <li>Username : {{$item['username']}}</li>
                                                <li>Name : {{$item['name']}}</li>
                                                <li>Email : {{$item['email']}}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Slug : {{ $item->brand_slug }}</li>
                                                <li>Status : 
                                                    {!! ($item->brand_status == 1)
                                                    ?"<button class='btn btn-success btn-xs'>Active</button>"
                                                    :"<button class='btn btn-danger btn-xs'>Not Active</button>" !!}
                                                </li>
                                                <li>Note : {{ $item->brand_note }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/brand/show/' . $item->id) }}">
                                                <button class="btn btn-info btn-xs">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>View
                                                </button>
                                            </a>
                                            <a href="{{ url('/admin/brand/edit/' . $item->id) }}">
                                                <button class="btn btn-warning btn-xs">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>Edit
                                                </button>
                                            </a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/brand/destroy', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'type' => 'submit',
                                                        'title' => 'Delete blog',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $brand->appends(['search' => Request::get('search')])->render() !!} </div>
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
</script>
@endsection
        