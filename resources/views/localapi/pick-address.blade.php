

<div class="modal fade11" id="modal-madil{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="slideshow-container11">
          <div class="table-responsive">
                <table class="table m-t-20 respon">
                    <thead>
                        <th></th>
                        <th>Info</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </thead>
                    @foreach(Auth::user()->user_address as $item)
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
      </div>
    </div>
  </div>
</div>