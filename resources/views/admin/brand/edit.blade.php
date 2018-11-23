@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Brand</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/admin/brand') }}" title="Back">
                	<button class="btn btn-warning btn-xs">
                		<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                	</button>
                </a>
                <br />
                <br />
                {!! Form::model($brand, [
                    'method' => 'PATCH',
                    'url' => ['/admin/brand/update', $brand->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                    @include ('admin.brand.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        