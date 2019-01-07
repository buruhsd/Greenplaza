@foreach($shipment as $item)
    @foreach($item['costs'] as $item)
        <input type="button" value="{{$item['service']}} : Rp. {{$item['cost'][0]['value']}}" class="btn btn-info btn-sm col-12" onclick="change_ongkir('{{$item["service"]}}', {{$item['cost'][0]['value']}});" />
    @endforeach
@endforeach