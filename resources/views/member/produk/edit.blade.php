@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Produk</h3>
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
                		<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                	</button>
                </a>
                <br />
                <br />
                {!! Form::model($produk, [
                    'method' => 'PATCH',
                    'url' => ['/member/produk/update', $produk->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                {!! Form::open(['url' => '/member/produk/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include ('member.produk.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection
        