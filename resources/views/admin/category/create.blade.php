@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Category</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/admin/category') }}" title="Back">
                    <button class="btn btn-warning btn-xs">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                <br />
                <br />
                {!! Form::open(['url' => '/admin/category/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include ('admin.category.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        