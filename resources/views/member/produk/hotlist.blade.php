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
                                    <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
                                        {!! Form::label('id', 'Kategori : ', ['class' => 'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            <select name='id' class="form-control" id="id" onchange="get_hotlist();">
                                                @foreach($produk as $item)
                                                <option value='{{$item->id}}'>{{$item->produk_name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_hotlist') ? 'has-error' : ''}}">
                                        {!! Form::label('produk_hotlist', 'Total Hotlist : ', ['class' => 'col-md-3 control-label']) !!}
                                        <div class="col-md-9">
                                            {!! Form::number('produk_hotlist', null, [
                                                'class' => 'form-control', 
                                                'id' => 'produk_hotlist',
                                                'placeholder' => 'Total Hotlist', 
                                                'required'
                                            ])!!}
                                        {!! $errors->first('produk_hotlist', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary mb-2 btn-block">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success col-md-6">
                            <div class="panel-body">
                                <h4><b>Informasi</b></h4>
                                <p>Produk Hotlist akan di tampilkan di halaman utama.</p>
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $id = $('#id');
            get_hotlist($id);
        });
        function get_hotlist(e){
            id = e.val();
            $.ajax({
                type: 'get', // or post?
                url: '{{url('localapi/content/get_hotlist')}}/'+id, // change as needed
                success: function(data) {
                    $('#produk_hotlist').val(data);
                }
            });
        }
    </script>
@endsection