@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Category</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                    <form action="#" method="GET">
                    <div class="input-group pull-left" style="width: 225px;">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Position ..."></a>
                    </div>
                </form>
                </div>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Category List</h4>

                    <a href="{{ url('admin/category/') }}"><button type="button" class="btn btn-info">All Category<span class="label label-default pull-right">{{App\Models\Category::get()->count()}}</span></button></a>

                    <a href="{{ url('admin/category/parent') }}"><button type="button" class="btn btn-info">Parent Category<span class="label label-default pull-right">{{App\Models\Category::where('category_parent_id', '=', 0)->get()->count()}}</span></button></a>

                    <a href="{{ url('admin/category/child') }}"><button type="button" class="btn btn-info">Child Category<span class="label label-default pull-right">{{App\Models\Category::where('category_parent_id', '!=', 0)->get()->count()}}</span></button></a>

                    <a href="{{ url('admin/category/create') }}" class="btn btn-success btn-sm pull-right">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" id="scroll_hor">
                            <thead>
                                <tr>
                                    <th><center>ID</center></th>
                                    <th><center>Reff</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Keterangan</center></th>
                                    <!-- <th>Usable</th> -->
                                    <th><center>Status</center></th>
                                    <th><center>Position</center></th>
                                    <th><center>Note</center></th>
                                    <th><center>Actions</center></th>
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
                                        <!-- <td>{!! ($item->category_is_usable == 1)
                                            ?"<button class='btn btn-success btn-xs'>Use</button>"
                                            :"<button class='btn btn-danger btn-xs'>Not Use</button>" !!}</td> -->
                                        <td>{!! ($item->category_status == 1)
                                            ?"<button class='btn btn-success btn-xs'>Active</button>"
                                            :"<button class='btn btn-danger btn-xs'>Not Active</button>" !!}</td>
                                        <td><center>{{$item->position}}</center></td>
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
@section('scripts')
@endsection
        