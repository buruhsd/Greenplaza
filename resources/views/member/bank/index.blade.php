@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Rekening Bank</h3>
</div>
<div class="panel panel-white">
    <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addbank")}} type="button" class="btn btn-danger btn-sm" name="addBank" value="Tambah Rekening Baru" />
</div>
<div id="main-wrapper">
    <div class="row">
        <?php $no = 1; ?>
        @foreach($user->user_bank->all() as $item)
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4><b>{{$item->user_bank_no}} </b>{!!($item->user_bank_status == 1)?"<i class='btn btn-danger disabled'>Default</i>":""!!}</h4>
                    </div>
                    <div class="panel-body">
                        <i>Atas nama : {{$item->user_bank_owner}}</i><br>
                        Bank : {{$item->user_bank_name}}<br><br>
                        <div class="col-md-6">
                            <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.editbank", $item->id)}} type="button" class="btn btn-danger btn-sm btn-block" name="editbank" value="Ubah" />
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="{{route('member.bank.set_default', $item->id)}}" ><b>Set to Default</b></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
                                   
        
                                        
                                           

                                