<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Pilih Alamat</h4>
        </div>
        <div class="modal-body">
            <div class="row m-t-20">
                <div class="col-12">
                    <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-success btn-sm" name="addAdress" value="Add Address" />
                </div>
            </div>
            <div class="table-responsive">
                <table class="table m-t-20 respon">
                    <thead>
                        <th></th>
                        <th>Info</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </thead>
                    @foreach($user_address as $item)
                        <tbody>
                            <td></td>
                            <td>
                                <ul>
                                    <li>Penerima : {{$item->user_address_owner}}</li>
                                    <li>No. Hp : {{$item->user_address_phone}}</li>
                                    <li>Telpon : {{$item->user_address_tlp}}</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Alamat : {{FunctionLib::address_info($item->id)}}</li>
                                    {{-- <li>Propinsi : {{$item->user_address_province}}</li>
                                    <li>Kota / Kab : {{$item->user_address_city}}</li>
                                    <li>Desa / Kelurahan : {{$item->user_address_subdist}}</li>
                                    <li>Alamat : {{$item->user_address_address}}</li> --}}
                                    <li>Kode Pos : {{$item->user_address_pos}}</li>
                                </ul>
                            </td>
                            <td>
                                <input type="button" class="btn btn-success btn-sm" onclick="$(this).closest('.modal').modal('hide');use_address({{$item->id}}, '{{$item->user_address_label}}', {{$item->user_address_city}}, {{$item->user_address_subdist}});" value="Use {{$item->user_address_label}}">
                            </td>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" value="Close" onclick="$(this).closest('.modal').modal('hide')">
        </div>
    </div>
</div>