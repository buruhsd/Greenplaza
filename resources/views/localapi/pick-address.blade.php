<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Choose Adrees</h4>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Telpon</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Subdistrict</th>
                        <th>Postal Code</th>
                        <th>Address</th>
                        <th>Pick</th>
                    </thead>
                    @foreach($user_address as $item)
                        <tbody>
                            <td>{{$item->user_address_owner}}</td>
                            <td>{{$item->user_address_phone}}</td>
                            <td>{{$item->user_address_tlp}}</td>
                            <td>{{$item->user_address_province}}</td>
                            <td>{{$item->user_address_city}}</td>
                            <td>{{$item->user_address_subdist}}</td>
                            <td>{{$item->user_address_pos}}</td>
                            <td>{{$item->user_address_address}}</td>
                            <td>
                                <input type="button" data-dismiss="modal" data-toggle='modal' class="btn btn-success btn-sm" onclick="use_address({{$item->user_address_city}}, {{$item->user_address_subdist}});" value="Use {{$item->user_address_label}}">
                            </td>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>