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
                <br />
                <br />
                {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/member/user/update', $user->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                {!! Form::open(['url' => '/member/user/store', 'class' => 'form-horizontal', 'files' => true]) !!}
                    @include ('member.user.form')
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection