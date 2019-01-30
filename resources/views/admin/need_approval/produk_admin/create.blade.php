@extends('admin.index')
@section('need approval', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Tambah Produk</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/admin/needapproval/produkadmin') }}" title="Back">
                    <button class="btn btn-warning btn-xs">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> kembali
                    </button>
                </a>
                <br />
                <br />
                @if(!Auth::user()->user_shipment()->exists())
                    <div class="col-md-12 text-center">
                        <a href="{{route('admin.user.set_shipment')}}" class="btn btn-sm btn-success">Update Jasa pengiriman</a>
                    </div>
                @else
                    {!! Form::open(['url' => '/admin/produk_admin/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                        @include ('admin.produk_admin.form')
                    {!! Form::close() !!}
                @endif
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        