<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Choose Adrees</h4>
        </div>
        <div class="modal-body">
            <div class="row m-t-20">
                <div class="col-12">
                    <input onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-success btn-sm" name="addAdress" value="Add Address" />
                </div>
            </div>
            <table class="table m-t-20">
                <thead>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Phone</th>
                    <th>Province</th>
                    <th>City</th>
                    <th>Subdistrict</th>
                    <th>Postal Code</th>
                    <th>Address</th>
                    <th>Pick</th>
                </thead>
                @foreach($user_address as $item)
                    <tbody>
                        <td>{{$user_address_owner}}</td>
                        <td>{{$user_address_phone}}</td>
                        <td>{{$user_address_tlp}}</td>
                        <td>{{$user_address_province}}</td>
                        <td>{{$user_address_city}}</td>
                        <td>{{$user_address_subdist}}</td>
                        <td>{{$user_address_pos}}</td>
                        <td>{{$user_address_address}}</td>
                        <td>{{$user_address_label}}</td>
                    </tbody>
                @endforeach
            </table>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>