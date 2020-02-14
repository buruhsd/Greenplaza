@extends('member.index')
@section('produk & brand', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Add Produk</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
        <section id="main-content">
            {{-- <p>{!! $errors !!}</p> --}}
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                <a href="{{ url('/member/produk') }}" title="Back">
                    <button class="btn btn-warning btn-xs">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                <br />
                <br />
                    <div class="col-md-12 text-center">
                @if(!Auth::user()->user_shipment()->exists())
                        <a href="{{route('member.user.set_shipment')}}" class="btn btn-sm btn-success">shipping service updates</a>
                @elseif(!Auth::user()->user_bank()->exists())
                        <a href="{{route('member.bank.index')}}" class="btn btn-sm btn-success">Add Bank</a>
                @else
                    </div>
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
        