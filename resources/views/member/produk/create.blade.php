@extends('member.index')
@section('produk & brand', 'active-page')
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
                        @include ('member.produk.form')
                    {!! Form::close() !!}
                @endif
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        