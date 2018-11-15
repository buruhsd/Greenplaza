@foreach($shipment as $item)
    @foreach($item['costs'] as $item)
        <li class="col-12">
            <input type="button" value="{{$item['service']}} : Rp. {{$item['cost'][0]['value']}}" class="btn btn-info btn-sm col-12" onclick="change_ongkir('{{$item["service"]}}', {{$item['cost'][0]['value']}});" />
        </li>
    @endforeach
@endforeach