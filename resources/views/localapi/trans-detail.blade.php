<style type="text/css">
.dotcirlce {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
}
</style>
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Transaction Detail</h4>
        </div>
        <div class="modal-body">
            {{-- <div class="row m-t-20">
                <div class="col-12">
                    <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-success btn-sm" name="addAdress" value="Add Address" />
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="table table-bordered m-t-xs">
                    <thead>
                        <th class="text-center">Code</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Produk Detail</th>
                        <th class="text-center">Seller Detail</th>
                        <th class="text-center">Shipment Detail</th>
                        <th class="text-center">Transaction Detail</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @foreach($trans_detail as $item)
                        <tr>
                            <td><b>{{$item->trans_code}}</b></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <img src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" style="max-height: 100px;">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <ul>
                                    <input type="hidden" id="sendcolorid" value="{{$item->trans_detail_color}}">
                                    <li>Name : {{$item->produk->produk_name}}</li>
                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
                                    <li>Warna:<br/> <span class="dotcirlce colornew"></span></li>
                                @if ($item->trans_detail_is_cancel == 0)
                                    <li>Status : <button class="btn btn-info btn-xs">{{FunctionLib::trans_arr($item->trans_detail_status)}}</button></li>
                                @else
                                    <li>Status : <button class="btn btn-info btn-xs">Cancel</button></li>
                                @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Username : {{$item->produk->user->username}}</li>
                                    <li>Name : {{$item->produk->user->name}}</li>
                                    <li>Email : {{$item->produk->user->email}}</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>From : 
                                        {{
                                            FunctionLib::address_info($item->produk->user->user_address->first()->id)
                                        }}, 
                                        {{
                                            $item->produk->user->user_address->first()->user_address_phone
                                        }}, 
                                        <b>{{
                                            $item->produk->user->user_address->first()->user_address_owner
                                        }}</b>
                                    </li>
                                    <li>To : 
                                        {{
                                            FunctionLib::address_info($item->user_address->id)
                                        }}, 
                                        {{
                                            $item->user_address->user_address_phone
                                        }}, 
                                        <b>{{
                                            $item->user_address->user_address_owner
                                        }}</b>
                                    </li>
                                    {{-- @if($item->trans_detail_status == 5) --}}
                                    <?php $ship_status = FunctionLib::get_waybill($item->id);?>
                                    <li>Sent Status : 
                                        {{
                                            $ship_status
                                        }}
                                    </li>
                                    <li>Jasa Pengiriman : {{$item->shipment->shipment_name}}</li>
                                    <li><b>&nbsp;&nbsp;-> {{$item->trans_detail_shipment_service}}</b></li>
                                    {{-- @endif --}}
                                </ul>
                            </td>
                            <td>
                                <ul>
                                
                                        @if($item->trans->trans_payment_id == 4 && $item->gln !== null )
                                        <li>Fee Gln : {{ $item->gln->trans_gln_amount_fee }} </li>
                                        <li>Jumlah Gln : {{ $item->gln->trans_gln_amount }} </li>
                                        <li>Total Gln : {{ $item->gln->trans_gln_amount_total }} </li>
                                        <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                        <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                        <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                        @if ($item->trans_detail_is_cancel == 1)
                                            <li><button class="btn btn-info btn-xs">Deskripsi </button>: {{$item->trans_detail_note}}</li>
                                        @else
                                        @endif
                                    @else
                                        <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                        <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                        <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                        @if ($item->trans_detail_is_cancel == 1)
                                            <li><button class="btn btn-info btn-xs">Deskripsi </button>: {{$item->trans_detail_note}}</li>
                                        @else
                                        @endif
                                    @endif
                                
                                </ul>
                            </td>
                            <td>
                                {!!Plugin::trans_purchase_btn(['id' => $item->trans->id, 'status' => 'detail', 'type' => $type])!!}
                            </td>
                        </tr>
                    @endforeach
                        @if(!$item->trans->trans_seller_note)
                            <tr>
                                <td colspan="2">
                                    Pesan Pembeli : <br>
                                </td>
                                <td colspan="5">
                                    
                                    <b>
                                      -  
                                    </b>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2">
                                    Pesan Pembeli : <br>
                                </td>
                                <td colspan="5">
                                    
                                    <b>
                                      {{$item->trans->trans_seller_note}}
                                    </b>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="bg-info" colspan="5">
                                Total Bayar : <br>
                            </td>
                            <td class="bg-info text-right" colspan="2">
                                <u>
                                <b>
                                    Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total'))}}
                                </b></u>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>
<script type="text/javascript">
var setcolorfromview = $('#sendcolorid').val();
var selected = setcolorfromview;

function checkColor() {
  var c = selected.substring(1);
  var rgb = parseInt(c, 16);
  var r = (rgb >> 16) & 0xff;
  var g = (rgb >> 8) & 0xff;
  var b = (rgb >> 0) & 0xff;

  var luma = Math.floor(0.2126 * r + 0.7152 * g + 0.0722 * b);

  if (luma < 126) {
    return "#ffffff";
  } else {
    return "#000000";
  }
}

var hex = document.createElement("div");
hex.style.color = checkColor();
hex.innerHTML = selected;

var colorInput = document.createElement("input");
colorInput.type = "color";
colorInput.id = "colorpicker";

function ColorPicker(element, data) {
  this.data = data;
  this.element = element;
  element.value = data;
  element.addEventListener("change", this, false);
}

ColorPicker.prototype.handleEvent = function(event) {
  switch (event.type) {
    case "change":
      this.change(this.element.value);
  }
};

ColorPicker.prototype.change = function(value) {
  this.data = value;
  this.element.value = value;
  selected = value;
  hex.innerHTML = selected;
  hex.style.color = checkColor();
  document.body.style.backgroundColor = selected;
};
// document.body.append(hex);
// document.body.append(colorInput);

// var myColorPicker = new ColorPicker(colorInput, selected);
$(".colornew").css("background-color", selected);


</script>