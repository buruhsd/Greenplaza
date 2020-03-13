<div class="featured-wrap">
    <div class="featured-img ">
        {{-- <table class="table table-bordered">
          <tbody>
            <tr>
              
              <td><img src="{{asset('/frontend/images/icon/hotel.png')}}" style="width: 30px;" alt="alt text"> Hotel</td>
              <td><img src="{{asset('/frontend/images/icon/game.png')}}" style="width: 30px;" alt="alt text"> Game</td>
              <td><img src="{{asset('/frontend/images/icon/kartukredit.png')}}" style="width: 30px;" alt="alt text"> Payment</td>
            </tr>
            <tr>
              
              <td><img src="{{asset('/frontend/images/icon/pesawat.png')}}" style="width: 20px;" alt="alt text"> Tiket Pesawat</td>
              <td><img src="{{asset('/frontend/images/icon/pay.png')}}" style="width: 20px;" alt="alt text"> Pembayaran</td>
              <td><img src="{{asset('/frontend/images/icon/pdam.png')}}" style="width: 20px;" alt="alt text"> Air PDAM</td>
            </tr>
            <tr>
              
              <td><img src="{{asset('/frontend/images/icon/plnprabayar.png')}}" style="width: 20px;" alt="alt text"> Listrik PLN</td>
              <td><img src="{{asset('/frontend/images/icon/tv.png')}}" style="width: 20px;" alt="alt text"> TV Berbayar</td>
              <td><img src="{{asset('/frontend/images/icon/ticket.png')}}" style="width: 20px;" alt="alt text"> Ticket Online</td>
            </tr>

            <tr>
              
              <td><img src="{{asset('/frontend/images/icon/topupsaldo.png')}}" style="width: 20px;" alt="alt text"> TopUp Saldo</td>
              <td><img src="{{asset('/frontend/images/icon/voucherfisik.png')}}" style="width: 20px;" alt="alt text"> Voucher</td>
              <td><img src="{{asset('/frontend/images/icon/voucheronline.png')}}" style="width: 20px;" alt="alt text"> Voucher Online</td>
            </tr>
          </tbody>
        </table> --}}
        @if($iklan->iklan_link == null || $iklan->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$iklan->iklan_link}}">
        @endif
            <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image) }}" alt="" style="height: 260px">
        </a>
        <div class="featured-content">
            {{-- <h2>Minilam Chair</h2>
            <p>consectetur adipisicing elit to Tempora, similique!</p> --}}
            <ul>
                <li><a href="{{url("/comming-soon")}}">Comming Sooooon</a></li>
            </ul>
        </div>
    </div>
</div>