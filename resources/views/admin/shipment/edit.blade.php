@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Shipment</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/admin/shipment') }}" title="Back">
                	<button class="btn btn-warning btn-xs">
                		<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                	</button>
                </a>
                <br />
                <br />
                {!! Form::model($shipment, [
                    'method' => 'PATCH',
                    'url' => ['/admin/shipment/update', $shipment->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                    @include ('admin.shipment.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        