@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Atur Kurir</h3>
    </div>
    <div id="main-wrapper">                      
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Pilih Kurir</h4>
                    </div>
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => ['/member/user/set_shipment_update'],
                        'class' => 'form-horizontal',
                        'files' => false
                    ]) !!}
                        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_shipment_shipment_id') ? 'has-error' : ''}}">
                            {!! Form::label('user_shipment_shipment_id', 'Pilih Pengiriman : ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                @foreach($shipment as $item)
                                    <?php $status = FunctionLib::have_shipment($item->id, Auth::id()); ?>
                                    <div class="col-md-6 m-b-xs">
                                        <div class="" data-toggle="buttons">
                                            <label class="btn btn-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}} btn-block {{($status)?'active':''}}">
                                                <input type="checkbox" name="user_shipment_shipment_id[]" value="{{$item->id}}" autocomplete="off" {{($status)?'checked':''}}>
                                                {{$item->shipment_name}}
                                                <span class="check glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                {!! $errors->first('user_shipment_shipment_id', '<p class="help-block">Pengiriman dibutuhkan</p>') !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="btn btn-block btn-info">
                    <?php 
                        $shipment = App\Models\Shipment::whereIn('id', $user->user_shipment()->pluck('user_shipment_shipment_id')->toArray())->pluck('shipment_name')->toArray();
                    ?>
                    Layanan Kurir Anda : {{implode (", ", $shipment)}}
                </label>
            </div>
        </div>
    </div>
</div>
@endsection
                                   
        
                                        
                                           

                                