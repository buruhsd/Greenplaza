
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="{{route('member.home')}}">
                   <img  src="{{asset('assets/images/gi_logo.png')}}" style="width: 120px; height: 40px;">
                    <!-- <span>Greenplaza</span> -->
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="{{FunctionLib::setActive('member/dashboard')}}">
                                <a href="{{route('member.dashboard')}}">
                                    <img src="{{asset('/frontend/images/gi/dashboard.png')}}" style="width: 20px;" alt="alt text" /><span> Dashboard</span>
                                </a>
                            </li>
                            {{-- @if(Auth::user()->is_verify()) --}}
                                {{-- need actived --}}
                                @if(Auth::user()->seller_active())
                                <li class="@yield('sales')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/penjualan.png')}}" style="width: 20px;" alt="alt text" />
                                            <span> Penjualan</span>
                                        <i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/transaction/sales')}}">
                                            <a href="{{route('member.transaction.sales')}}">
                                                Transaksi
                                                <span class="label label-danger pull-right badge" data-toggle="popover" title="Informasi : " data-html="true" 
                                                data-content="<small>
                                                    <table>
                                                        <tr><th>{{FunctionLib::count_trans('3', Auth::id(), 'seller')}} Menunggu Seller</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('4', Auth::id(), 'seller')}} Packing</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('5', Auth::id(), 'seller')}} Shipping</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('6', Auth::id(), 'seller')}} Dropping</th></tr>
                                                    </table>
                                                </small>"
                                                 data-placement="bottom" data-trigger="hover">{{FunctionLib::count_trans('3,4,5,6', Auth::id(), 'seller')}}</span>
                                                <span class="label label-info pull-right badge" data-toggle="popover" title="Informasi : " data-html="true" 
                                                data-content="<small>
                                                    <table>
                                                        <tr><th>{{FunctionLib::count_trans('0', Auth::id(), 'seller')}} Order</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('1', Auth::id(), 'seller')}} Konfirmasi Pembayaran</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('2', Auth::id(), 'seller')}} Transfer</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('7', Auth::id(), 'seller')}} Cancel</th></tr>
                                                    </table>
                                                </small>"
                                                 data-placement="bottom" data-trigger="hover">{{FunctionLib::count_trans('0,1,2,7', Auth::id(), 'seller')}}</span>
                                            </a>
                                        </li>
                                        <li class="{{FunctionLib::setActive('member/komplain')}}"><a href="{{route('member.komplain.index')}}">Resolusi Komplain</a></li>
                                    </ul>
                                </li>
                                @endif
                                {{-- need actived --}}
                                <li class="@yield('purchase')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/pembelian.png')}}" style="width: 20px;" alt="alt text" /><span> Pembelian</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/transaction/purchase')}}">
                                            <a href="{{route('member.transaction.purchase')}}">
                                                Transaksi
                                                <span class="label label-info pull-right badge" data-toggle="popover" title="Informasi : " data-html="true" 
                                                data-content="<small>
                                                    <table>
                                                        <tr><th>{{FunctionLib::count_trans('3', Auth::id())}} Menunggu Seller</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('4', Auth::id())}} Packing</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('6', Auth::id())}} Dropping</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('7', Auth::id())}} Cancel</th></tr>
                                                    </table>
                                                </small>"
                                                 data-placement="bottom" data-trigger="hover">
                                                    {{FunctionLib::count_trans('3,4,6', Auth::id()) + FunctionLib::count_trans('7', Auth::id())}}
                                                </span>
                                                <span class="label label-danger pull-right badge" data-toggle="popover" title="Informasi : " data-html="true" 
                                                data-content="<small>
                                                    <table>
                                                        <tr><th>{{FunctionLib::count_trans('0', Auth::id())}} Order</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('1', Auth::id())}} Konfirmasi Pembayaran</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('2', Auth::id())}} Transfer</th></tr>
                                                        <tr><th>{{FunctionLib::count_trans('5', Auth::id())}} Shipping</th></tr>
                                                    </table>
                                                </small>"
                                                 data-placement="bottom" data-trigger="hover">
                                                    {{FunctionLib::count_trans('0,1,2,5', Auth::id())}}
                                                </span>
                                            </a>
                                        </li>
                                        <li class="{{FunctionLib::setActive('member/komplain/buyer')}}"><a href="{{route('member.komplain.buyer')}}">Resolusi Komplain</a></li>
                                        <li class="{{FunctionLib::setActive('member/wishlist')}}"><a href="{{route('member.wishlist')}}">Wishlist</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                @if(Auth::user()->seller_active())
                                <li class="@yield('get penjual')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/getpenjual.png')}}" style="width: 20px;" alt="alt text" /><span> Get Penjual</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/user/sponsor')}} hidden"><a href="{{route('member.user.sponsor')}}">Sponsor</a></li>
                                        {{-- <li class="{{FunctionLib::setActive('member/sponsor/register')}}"><a href="{{route('member.sponsor.register')}}">Register Penjual</a></li> --}}
                                        <li class="{{FunctionLib::setActive('member/wallet')}}"><a href="{{route('member.wallet.index')}}">History Saldo</a></li>
                                        <li class="{{FunctionLib::setActive('member/wallet/withdrawal')}}"><a href="{{route('member.wallet.withdrawal')}}">Withdrawal</a></li>
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/transfer_cw')}}"><a href="{{route('member.wallet.transfer_cw')}}">Transfer CW</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/transfer_rw')}}"><a href="{{route('member.wallet.transfer_rw')}}">Transfer RW</a></li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('member.notification.index_notif')}}">
                                        <img src="{{asset('/frontend/images/gi/lonceng.png')}}" style="width: 20px;" alt="alt text" /> Notification
                                    </a>
                                </li>
                                @endif
                                <li class="@yield('pengaturan profil')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/profile.png')}}" style="width: 20px;" alt="alt text" /><span> Pengaturan Profil</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <h4 class="m-l-sm text-danger">Seller</h4>
                                        @if(Auth::user()->seller_active())
                                            <li class="{{FunctionLib::setActive('member/user/set_payment')}}"><a href="{{route('member.user.set_payment')}}">Atur Pembayaran</a></li>
                                        @endif
                                        <li class="{{FunctionLib::setActive('member/profil')}}"><a href="{{route('member.profil')}}">Profil Anda</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/change_password')}}"><a href="{{route('member.user.change_password')}}">Ubah Password Login</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/pass_trx')}}"><a href="{{route('member.user.pass_trx')}}">Ubah Password Transaksi</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/seller_address')}}"><a href="{{route('member.user.seller_address')}}">Alamat Seller</a></li>
                                        <!-- <li class="{{FunctionLib::setActive('member/user/upload_foto_profil')}}"><a href="{{route('member.user.upload_foto_profil')}}">Upload Foto Profil</a></li> -->
                                        <li class="{{FunctionLib::setActive('member/user/upload_scan_npwp')}}"><a href="{{route('member.user.upload_scan_npwp')}}">Upload Scan NPWP</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/upload_siup')}}"><a href="{{route('member.user.upload_siup')}}">Upload Scan SIUP/TDP</a></li>

                                        <h4 class="m-l-sm text-danger">Buyer</h4>
                                        {{-- <li class="{{FunctionLib::setActive('member/sponsor/index')}}"><a href="{{route('member.sponsor.index')}}">Biodata</a></li> --}}
                                        <li class="{{FunctionLib::setActive('member/user/buyer_address')}}"><a href="{{route('member.user.buyer_address')}}">Alamat Kirim</a></li>
                                        <li class="{{FunctionLib::setActive('member/bank/index')}}{{FunctionLib::setActive('member/bank')}}"><a href="{{route('member.bank.index')}}">Rekening Bank</a></li>
                                        {{-- <li class="{{FunctionLib::setActive('member/Withdrawal/create')}}"><a href="{{route('member.Withdrawal.create')}}">Ubah Password Login</a></li> --}}
                                        {{-- <li class="{{FunctionLib::setActive('member/cw/index')}}"><a href="{{route('member.cw.index')}}">Ubah Password Transaksi</a></li> --}}
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                <li class="@yield('pesan & diskusi')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/chat.png')}}" style="width: 20px;" alt="alt text" /><span> Pesan & Diskusi</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/message')}}"><a href="{{route('member.message.index')}}">Pesan</a></li>
                                        <li class="{{FunctionLib::setActive('member/produk/discuss')}}"><a href="{{route('member.produk.discuss.index')}}">Diskusi Produk</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                @if(Auth::user()->seller_active())
                                <li class="@yield('produk & brand')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/produk.png')}}" style="width: 20px;" alt="alt text" /><span> Produk</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/produk/create')}}"><a href="{{route('member.produk.create')}}">Tambah Produk</a></li>
                                        <li class="{{FunctionLib::setActive('member/produk')}}"><a href="{{route('member.produk.index')}}">Daftar Produk</a></li>
                                        {{-- <li class="{{FunctionLib::setActive('member/brand')}}"><a href="{{route('member.brand.index')}}">Daftar Brand</a></li> --}}
                                    </ul>
                                </li>
                                @endif
                                {{-- need actived --}}
                                <li class="@yield('hot list') hidden">
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Hot List</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/hotlist/buy_poin')}}"><a href="{{route('member.hotlist.buy_poin')}}">Buy Poin Hot List</a></li>
                                        <li class="{{FunctionLib::setActive('member/hotlist/tagihan')}}"><a href="{{route('member.hotlist.tagihan')}}">Tagihan Hot List</a></li>
                                        <li class="{{FunctionLib::setActive('member/hotlist/history')}}"><a href="{{route('member.hotlist.history')}}">History Hot List Produk</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                <li class="@yield('pin code') hidden">
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>PIN Code</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/pincode/buy_pincode')}}"><a href="{{route('member.pincode.buy_pincode')}}">Beli Pin Kode</a></li>
                                        <li class="{{FunctionLib::setActive('member/pincode/tagihan')}}"><a href="{{route('member.pincode.tagihan')}}">Tagihan Pin Kode</a></li>
                                        <li class="{{FunctionLib::setActive('member/pincode/list')}}"><a href="{{route('member.pincode.history')}}">Daftar Pin Kode</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                <li class="@yield('pasang iklan')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/iklan.png')}}" style="width: 20px;" alt="alt text" /><span> Pasang Iklan</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/iklan/beli_saldo')}}"><a href="{{route('member.iklan.beli_saldo')}}">Beli Saldo Iklan</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/tagihan')}}"><a href="{{route('member.iklan.tagihan')}}">Tagihan Iklan</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/baris')}}"><a href="{{route('member.iklan.baris')}}">Iklan Baris</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/banner')}}"><a href="{{route('member.iklan.banner')}}">Iklan Banner</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/banner_khusus')}}"><a href="{{route('member.iklan.banner_khusus')}}">Iklan Banner Khusus</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/history')}}"><a href="{{route('member.iklan.history')}}">History Iklan</a></li>
                                    </ul>
                                </li>
                                @if(Auth::user()->seller_active())
                                <li class="{{FunctionLib::setActive('member/user/set_shipment')}}">
                                    <a href="{{route('member.user.set_shipment')}}">
                                        <img src="{{asset('/frontend/images/gi/kurir.png')}}" style="width: 20px;" alt="alt text" /><span> Atur Kurir</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                </li>
                                @endif
                                {{-- need actived --}}
                                {{-- pembeli --}}
                                <li class="@yield('log')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/log.png')}}" style="width: 20px;" alt="alt text" /><span> Log</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/transaksi')}}"><a href="{{route('member.wallet.type', 'transaksi')}}">Log Cw Transaksi</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/cw')}}"><a href="{{route('member.wallet.type', 'cw')}}">Log Cw Bonus</a></li> -->
                                        <li class="{{FunctionLib::setActive('member/wallet/log_masedi')}}"><a href="{{route('member.wallet.log_masedi')}}">Log Masedi Transaction</a></li>
                                        <li><a href="{{route('member.wallet.type', 'transaksi')}}">Log Saldo Transaksi</a></li>
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/log_gln')}}"><a href="{{route('member.wallet.log_gln')}}">Log Gln Transaction</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/rw')}}"><a href="{{route('member.wallet.type', 'rw')}}">Log Rw</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/iklan')}}"><a href="{{route('member.wallet.type', 'iklan')}}">Log Saldo Iklan</a></li>
                                        <li class="{{FunctionLib::setActive('member/wallet/type/pincode')}}"><a href="{{route('member.wallet.type', 'pin_code')}}">Log Pincode</a></li> -->
                                        <li class="{{FunctionLib::setActive('member')}} hidden"><a href="{{-- {{route('member.wallet.type', 'transaksi')}} --}}">Log Aktifitas</a></li>
                                    </ul>
                                </li>
                            {{-- @endif --}}
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->