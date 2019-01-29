@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Show Category</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/admin/category') }}" title="Back">
                	<button class="btn btn-warning btn-xs" >
                		<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                	</button>
                </a>
                <br/>
	                <div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                            <tr>
	                                <th>Id</th>
	                                <td>: {{$category->id}}</td>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <th>Category Parent Id</th>
	                                <td>: {{$category->category_parent_id}}</td>
	                            </tr>
	                            <tr>
	                                <th>Category Name</th>
	                                <td>: {{$category->category_name}}</td>
	                            </tr>
	                            <tr>
	                                <th>Category Icon</th>
	                                <td>: {{$category->category_icon}}</td>
	                            </tr>
	                            <tr>
	                                <th>Category Slug</th>
	                                <td>: {{$category->category_slug}}</td>
	                            </tr>
	                            <tr>
	                                <th>Category Image</th>
	                                <td>: <img src="{{asset('assets/images/iklan/'.$category->category_image)}}" style="width: 200px"></td>
	                            </tr>
	                            <tr>
	                                <th>Category Status</th>
	                                <td>: {{$category->category_status}}</td>
	                            </tr>
	                            <tr>
	                                <th>Category Note</th>
	                                <td>: {{$category->category_note}}</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
</div>

@endsection