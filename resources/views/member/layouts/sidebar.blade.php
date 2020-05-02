
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
                                            <span> {{__('dashboard.penjualan') }}</span>
                                        <i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/transaction/sales')}}">
                                            <a href="{{route('member.transaction.sales')}}">
                                                {{__('dashboard.transaksi') }}
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
                                        <li class="{{FunctionLib::setActive('member/komplain')}}"><a href="{{route('member.komplain.index')}}">{{__('dashboard.komplain') }}</a></li>
                                    </ul>
                                </li>
                                @endif
                                {{-- need actived --}}
                                <li class="@yield('purchase')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/pembelian.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.pembelian') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/transaction/purchase')}}">
                                            <a href="{{route('member.transaction.purchase')}}">
                                                {{__('dashboard.transaksi') }}
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
                                        <li class="{{FunctionLib::setActive('member/komplain/buyer')}}"><a href="{{route('member.komplain.buyer')}}">{{__('dashboard.komplain') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/wishlist')}}"><a href="{{route('member.wishlist')}}">{{__('dashboard.wishlist') }}</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                @if(Auth::user()->seller_active())
                                <li class="@yield('get penjual')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/getpenjual.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.get_penjual') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/user/sponsor')}} hidden"><a href="{{route('member.user.sponsor')}}">Sponsor</a></li>
                                        {{-- <li class="{{FunctionLib::setActive('member/sponsor/register')}}"><a href="{{route('member.sponsor.register')}}">Register Penjual</a></li> --}}
                                        <li class="{{FunctionLib::setActive('member/wallet')}}"><a href="{{route('member.wallet.index')}}">{{__('dashboard.history_saldo') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/wallet/withdrawal')}}"><a href="{{route('member.wallet.withdrawal')}}">{{__('dashboard.withdrawal') }}</a></li>
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/transfer_cw')}}"><a href="{{route('member.wallet.transfer_cw')}}">Transfer CW</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/transfer_rw')}}"><a href="{{route('member.wallet.transfer_rw')}}">Transfer RW</a></li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('member.notification.index_notif')}}">
                                        <img src="{{asset('/frontend/images/gi/lonceng.png')}}" style="width: 20px;" alt="alt text" />{{__('dashboard.notification') }}
                                    </a>
                                </li>
                                @endif
                                <li class="@yield('pengaturan profil')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/profile.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.profil_setting') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <h4 class="m-l-sm text-danger">Seller</h4>
                                        {{-- @if(Auth::user()->seller_active())
                                            <li class="{{FunctionLib::setActive('member/user/set_payment')}}"><a href="{{route('member.user.set_payment')}}">{{__('dashboard.aturan_pembayaran') }}</a></li>
                                        @endif --}}
                                        <li class="{{FunctionLib::setActive('member/profil')}}"><a href="{{route('member.profil')}}">{{__('dashboard.profil_anda') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/change_password')}}"><a href="{{route('member.user.change_password')}}">{{__('dashboard.ubah_password_login') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/pass_trx')}}"><a href="{{route('member.user.pass_trx')}}">{{__('dashboard.ubah_password_transaksi') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/seller_address')}}"><a href="{{route('member.user.seller_address')}}">{{__('dashboard.alamat_seller') }}</a></li>
                                        <!-- <li class="{{FunctionLib::setActive('member/user/upload_foto_profil')}}"><a href="{{route('member.user.upload_foto_profil')}}">Upload Foto Profil</a></li> -->
                                        <li class="{{FunctionLib::setActive('member/user/upload_scan_npwp')}}"><a href="{{route('member.user.upload_scan_npwp')}}">{{__('dashboard.upload_npwp') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/user/upload_siup')}}"><a href="{{route('member.user.upload_siup')}}">{{__('dashboard.upload_siup') }}</a></li>

                                        <h4 class="m-l-sm text-danger">Buyer</h4>
                                        {{-- <li class="{{FunctionLib::setActive('member/sponsor/index')}}"><a href="{{route('member.sponsor.index')}}">Biodata</a></li> --}}
                                        <li class="{{FunctionLib::setActive('member/user/buyer_address')}}"><a href="{{route('member.user.buyer_address')}}">{{__('dashboard.alamat_kirim') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/bank/index')}}{{FunctionLib::setActive('member/bank')}}"><a href="{{route('member.bank.index')}}">{{__('dashboard.rekening') }}</a></li>
                                        {{-- <li class="{{FunctionLib::setActive('member/Withdrawal/create')}}"><a href="{{route('member.Withdrawal.create')}}">Ubah Password Login</a></li> --}}
                                        {{-- <li class="{{FunctionLib::setActive('member/cw/index')}}"><a href="{{route('member.cw.index')}}">Ubah Password Transaksi</a></li> --}}
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                <li class="@yield('pesan & diskusi')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/chat.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.pesan_diskusi') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/message')}}"><a href="{{route('member.message.index')}}">{{__('dashboard.pesan') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/produk/discuss')}}"><a href="{{route('member.produk.discuss.index')}}">{{__('dashboard.diskusi') }}</a></li>
                                    </ul>
                                </li>
                                {{-- need actived --}}
                                @if(Auth::user()->seller_active())
                                <li class="@yield('produk & brand')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/produk.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.produk') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/produk/create')}}"><a href="{{route('member.produk.create')}}">{{__('dashboard.tambah_produk') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/produk')}}"><a href="{{route('member.produk.index')}}">{{__('dashboard.daftar_produk') }}</a></li>
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
                                        <img src="{{asset('/frontend/images/gi/iklan.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.iklan') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="{{FunctionLib::setActive('member/iklan/beli_saldo')}}"><a href="{{route('member.iklan.beli_saldo')}}">{{__('dashboard.beli_saldo_iklan') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/tagihan')}}"><a href="{{route('member.iklan.tagihan')}}">{{__('dashboard.tagihan_iklan') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/baris')}}"><a href="{{route('member.iklan.baris')}}">{{__('dashboard.iklan_baris') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/banner')}}"><a href="{{route('member.iklan.banner')}}">{{__('dashboard.iklan_banner') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/banner_khusus')}}"><a href="{{route('member.iklan.banner_khusus')}}">{{__('dashboard.iklan_banner_khusus') }}</a></li>
                                        <li class="{{FunctionLib::setActive('member/iklan/history')}}"><a href="{{route('member.iklan.history')}}">{{__('dashboard.history_iklan') }}</a></li>
                                    </ul>
                                </li>
                                @if(Auth::user()->seller_active())
                                <li class="{{FunctionLib::setActive('member/user/set_shipment')}}">
                                    <a href="{{route('member.user.set_shipment')}}">
                                        <img src="{{asset('/frontend/images/gi/kurir.png')}}" style="width: 20px;" alt="alt text" /><span>{{__('dashboard.kurir') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                </li>
                                @endif
                                {{-- need actived --}}
                                {{-- pembeli --}}
                                <li class="@yield('log')">
                                    <a href="javascript:void(0)">
                                        <img src="{{asset('/frontend/images/gi/log.png')}}" style="width: 20px;" alt="alt text" /><span> {{__('dashboard.log') }}</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/transaksi')}}"><a href="{{route('member.wallet.type', 'transaksi')}}">Log Cw Transaksi</a></li> -->
                                        <!-- <li class="{{FunctionLib::setActive('member/wallet/type/cw')}}"><a href="{{route('member.wallet.type', 'cw')}}">Log Cw Bonus</a></li> -->
                                        <li class="{{FunctionLib::setActive('member/wallet/log_masedi')}}"><a href="{{route('member.wallet.log_masedi')}}">{{__('dashboard.log_masedi_transaction') }}</a></li>
                                        <li><a href="{{route('member.wallet.type', 'transaksi')}}">{{__('dashboard.log_saldo_transaction') }}</a></li>
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