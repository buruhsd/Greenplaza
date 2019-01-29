@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Category</h3>
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
                    <h4 class="panel-title">Configuration Category</h4>
                    <a href="{{ url('admin/category/create') }}" class="btn btn-success btn-sm pull-right">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reff</th>
                                    <th>Name</th>
                                    <th>Keterangan</th>
                                    <th>Usable</th>
                                    <th>status</th>
                                    <th>Note</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            {!! 
                                                ($item->par['category_name'])
                                                ?$item->par['category_name']
                                                :"<button class='btn btn-danger btn-xs'>On Top</button>"
                                            !!}
                                        </td>
                                        <td>{{ $item->category_name }}</td>
                                            
                                        @if ($item->category_parent_id == 0)
                                            <td style="color: red">Parent Category</td>
                                        @else 
                                            <td style="color: blue">Child Category</td>
                                        @endif
                                        <td>{!! ($item->category_is_usable == 1)
                                            ?"<button class='btn btn-success btn-xs'>Use</button>"
                                            :"<button class='btn btn-danger btn-xs'>Not Use</button>" !!}</td>
                                        <td>{!! ($item->category_status == 1)
                                            ?"<button class='btn btn-success btn-xs'>Active</button>"
                                            :"<button class='btn btn-danger btn-xs'>Not Active</button>" !!}</td>
                                        <td>{{ $item->category_note }}</td>
                                        <td>
                                            <a href="{{ url('/admin/category/show/' . $item->id) }}">
                                                <button class="btn btn-info btn-xs">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>View
                                                </button>
                                            </a>
                                            <a href="{{ url('/admin/category/edit/' . $item->id) }}">
                                                <button class="btn btn-warning btn-xs">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>Edit
                                                </button>
                                            </a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/category/destroy', $item->id],
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
                    <div> {!! $category->appends(['search' => Request::get('search')])->render() !!} </div>
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
        