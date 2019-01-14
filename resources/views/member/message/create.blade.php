@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Message</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="{{route('member.message.index')}}" method="GET" id="src" class="form-inline">
                  {{-- <div class="form-group mx-sm-3 mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Search" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
                  </div> --}}
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="from" {!! (!empty($_GET['status']) && $_GET['status'] == "from")?"selected":"" !!}>Inbox</option>
                        <option value="to" {!! (!empty($_GET['status']) && $_GET['status'] == "to")?"selected":"" !!}>Active</option>
                        <option value="arsip" {!! (!empty($_GET['status']) && $_GET['status'] == "arsip")?"selected":"" !!}>Block</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Produk</h4>
                    <button type="button" onclick="search('from');" class="btn btn-danger">
                        <i class="fa fa-arrow-down"></i> Inbox
                        <span class="label label-default pull-right"></span>
                    </button>
                    <button type="button" onclick="search('to');" class="btn btn-info">
                        <i class="fa fa-arrow-up"></i> Outbox
                        <span class="label label-default pull-right"></span>
                    </button>
                    <button type="button" onclick="search('arsip');" class="btn btn-warning">
                        <i class="fa fa-folder"></i> Arsip
                        <span class="label label-default pull-right"></span>
                    </button>
                    {{-- <a href="{{ url('member/produk/create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Request Product</a> --}}
                </div>
                <br/>
                <div class="panel-body">
                    {!! Form::open(['url' => '/member/message/store', 'class' => '', 'files' => false]) !!}
                        <label>Pesan Kepada : {{$user->name}}</label>
                        <div class="form-group m-b-sm {{ $errors->has('message_to_id') ? 'has-error' : ''}}">
                            <div class="col-md-12">
                                {!! Form::hidden('message_to_id', $user->id, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Subject', 
                                    'required'
                                ])!!}
                            {!! $errors->first('message_to_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group m-b-sm {{ $errors->has('produk_name') ? 'has-error' : ''}}">
                            {!! Form::label('message_subject', 'Subject : ', ['class' => 'col-md-12 control-label']) !!}
                            <div class="col-md-12">
                                {!! Form::text('message_subject', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Subject', 
                                    'required'
                                ])!!}
                            {!! $errors->first('message_subject', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group m-b-sm {{ $errors->has('produk_name') ? 'has-error' : ''}}">
                            {!! Form::label('message_text', 'message : ', ['class' => 'col-md-12 control-label']) !!}
                            <div class="col-md-12">
                                {!! Form::textarea('message_text', null, [
                                  'class' => 'form-control', 
                                  'placeholder' => 'Message', 
                                ])!!}
                            {!! $errors->first('message_text', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12 no-border m-t-sm">
                            <button type="submit" class="btn btn-primary mb-2">Kirim</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection