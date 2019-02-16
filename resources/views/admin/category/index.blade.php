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
                                
                            </tbody>
                        </table>
                    </div>
                    
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
        