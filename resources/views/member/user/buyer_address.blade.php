@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">{{__('dashboard.daftar_alamat') }}</h3>
</div>
<div class="panel panel-white">
    <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-danger btn-sm" name="addAdress" value="{{__('dashboard.tambah_alamat_baru') }}" />
</div>
<div id="main-wrapper">
    <div class="row">
        <?php $no = 1; ?>
        @foreach($user->user_address->all() as $item)
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                    <div class="panel-heading clearfix">
                        <h4><b>{{$item->user_address_label}} </b>{!!($item->user_address_status == 1)?"<i class='btn btn-danger disabled'>Default</i>":""!!}</h4>
                    </div>
                    </div>
                    <div class="panel-body">
                        <i>{{__('dashboard.penerima') }} : {{$item->user_address_owner}}</i><br>
                        {{FunctionLib::address_info($item->id)}}<br>
                        {{__('dashboard.kode_pos') }} {{$item->user_address_pos}}<br>
                        HP. {{$item->user_address_phone}}<br>
                        {{__('dashboard.phone') }}. {{$item->user_address_tlp}}<br><br>
                        <div class="col-md-6">
                            <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.editaddress", $item->id)}} type="button" class="btn btn-danger btn-sm btn-block" name="editAdress" value="{{__('dashboard.ganti') }}" />
                            {{-- <a class="btn btn-info btn-block" data-toggle="collapse" href="#edit{{$no}}" role="button" aria-expanded="false" aria-controls="edit"><b>Ubah</b></a> --}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="{{route('member.address.set_default', $item->id)}}" ><b>{{__('dashboard.set_default') }}</b></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
                                   
        
                                        
                                           

                                