@extends('member.index')
@section('produk & brand', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Produk Hotlist</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/member/produk') }}" title="Back">
                    <button class="btn btn-warning btn-xs">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> kembali
                    </button>
                </a>
                <br />
                <br />
                @if(!Auth::user()->user_shipment()->exists())
                    <div class="col-md-12 text-center">
                        <a href="{{route('member.user.set_shipment')}}" class="btn btn-sm btn-success">Update Jasa pengiriman</a>
                    </div>
                @else
                    {!! Form::open(['url' => '/member/produk/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                        <div class="panel panel-white col-md-6 no-border">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_name') ? 'has-error' : ''}}">
                                        {!! Form::label('produk_name', 'Nama : ', ['class' => 'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('produk_name', null, [
                                                'class' => 'form-control', 
                                                'placeholder' => 'Nama', 
                                                'required'
                                            ])!!}
                                        {!! $errors->first('produk_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        