
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="{{route('admin.home')}}">
                <img  src="{{asset('frontend/logo-fix.png')}}" style="width: 120px; height: 40px;">
                    <!-- <span>Greenplaza</span> -->
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li>
                                <a href=""><center>
                                <span>Saldo Gln Admin</span> <br>
                                    <?php
                                    $response = FunctionLib::gln('ballance', ['address'=>'W19AIiuj8YX9tO4Gk1yZ1CCFvbb3u06me']);
                                    if($response['status'] == 200){
                                        echo FunctionLib::number_to_text($response['data']['balance'], 8);
                                    }else{
                                        echo "0,00";
                                    }
                                    ?>
                                </center></a>
                            </li>

                            <li class="menu-divider"></li>
                            @if(Auth::user()->is_superadmin())
                            <li class="{{FunctionLib::setActive('admin/config')}}" >
                                <a href="{{route('admin.config.index')}}">
                                    <i class="menu-icon icon-fire"></i><span>Config</span>
                                </a>
                            </li>
                            @endif
                            <li class="{{FunctionLib::setActive('admin/dashboard')}}" >
                                <a href="{{route('admin.dashboard')}}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{route('admin.live_chat')}}">
                                    <i class="menu-icon icon-voice_chat"></i><span>Live Chat</span>
                                </a>
                            </li> -->
                            <li class="{{FunctionLib::setActive('admin/email_sender')}}">
                                <a href="{{route('admin.email_sender')}}">
                                    <i class="menu-icon icon-flash_on"></i><span>Email Sender</span>
                                </a>
                            </li>
                            <li class="@yield('masedi')">
                                <a href="">
                                    <i class="menu-icon icon-layers"></i><span>Log Transaksi</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{FunctionLib::setActive('admin/list_transaction_masedi')}}"><a href="{{route('admin.list_masedi')}}">Transaksi Masedi</a></li>
                                    <li class="{{FunctionLib::setActive('admin/list_transaction_gln')}}"><a href="{{route('admin.list_gln')}}">Transaksi Gln</a></li>
                                </ul>
                            </li>
                            <li class="{{FunctionLib::setActive('admin/res_kom')}}">
                                <a href="{{route('admin.res_kom.index')}}">
                                    <i class="menu-icon icon-inbox"></i><span>Resolusi Komplain</span>
                                </a>
                            </li>
                            <li class="{{FunctionLib::setActive('admin/hot_promo')}}">
                                <a href="{{route('admin.hot_promo')}}">
                                    <i class="menu-icon icon-fire"></i><span>Hot Promo</span>
                                </a>
                            </li>
                            <li class="@yield('monitoring')">
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-live_tv"></i><span>Monitoring</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{FunctionLib::setActive('admin/monitoring/laporan')}}"><a href="{{route('admin.monitoring.laporan')}}">Laporan</a></li>
                                    <!-- <li><a href="{{route('admin.monitoring.profit')}}">Profit</a></li> -->
                                    <li class="{{FunctionLib::setActive('admin/monitoring/wallet_memberlist')}}"><a href="{{route('admin.monitoring.wallet_memberlist')}}">Wallet</a></li>
                                    <!-- <li><a href="#">Wallet Pin Code</a></li>
                                    <li><a href="#">Wallet Saldo Iklan</a></li> -->
                                    <li class="{{FunctionLib::setActive('admin/monitoring/log_activity')}}"><a href="{{route('admin.monitoring.activity')}}">Log Aktivitas</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li class="@yield('need approval')">
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Need Approval</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{FunctionLib::setActive('admin/needapproval/gln')}}"><a href="{{route('admin.needapproval.gln')}}">Transaksi Greenline</a></li>
                                    <li class="{{FunctionLib::setActive('admin/transaction')}}"><a href="{{route('admin.transaction.index')}}">Transaksi Barang</a></li>
                                    <li class="{{FunctionLib::setActive('admin/needapproval/hotlist')}}"><a href="{{route('admin.needapproval.hotlist')}}">Transaksi Hot List</a></li>
                                    <li class="{{FunctionLib::setActive('admin/needapproval/pincode')}}"><a href="{{route('admin.needapproval.pincode')}}">Transaksi Pin Code</a></li>
                                    <li class="{{FunctionLib::setActive('admin/needapproval/listmember')}}"><a href="{{route('admin.needapproval.listmember')}}">Akun Member</a></li>
                                    <li class="{{FunctionLib::setActive('admin/brand')}}"><a href="{{route('admin.brand.index')}}">Brand</a></li>
                                    
                                    <!-- <li class="{{FunctionLib::setActive('admin/needapproval/banner_khusus')}}"><a href="{{route('admin.needapproval.banner_khusus')}}">Iklan Banner dan Baris</a></li> -->


                                    <!-- <li><a href="#">Iklan Banner Seller</a></li>
                                    <li><a href="#">Iklan Baris Seller</a></li>
                                    <li><a href="#">Iklan Banner Pembeli</a></li>
                                    <li><a href="#">Iklan Baris Pembeli</a></li> -->
                                    <li class="{{FunctionLib::setActive('admin/produk')}}"><a href="{{route('admin.produk.index')}}">Produk</a></li>
                                    <li class="{{FunctionLib::setActive('admin/needapproval/produkadmin')}}"><a href= "{{route('admin.needapproval.produkadmin')}}">Produk Admin</a></li>
                                    <li class="{{FunctionLib::setActive('admin/needapproval/saldoiklan')}}"><a href="{{route('admin.needapproval.saldoiklan')}}">Request Saldo Iklan</a></li><!-- 
                                    <li><a href="#">Withdrawal Seller</a></li> -->
                                    <li class="{{FunctionLib::setActive('admin/needapproval/withdrawal_member')}}"><a href="{{route('admin.needapproval.withdrawal_member')}}">Withdrawal Member</a></li>
                                </ul>
                            </li>
                            <li class="@yield('konfigurasi')">
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-cog"></i><span>Konfigurasi</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{FunctionLib::setActive('admin/category')}}">
                                        <h5 class="m-l-sm text-danger">Setting Produk</h5>
                                        <li><a href="{{route('admin.category.index')}}">Kategori Produk</a></li>
                                    </li>
                                    <!-- <li>
                                        <h4 class="m-l-sm text-danger">Setting Harga</h4>
                                        <li><a href="{{route('admin.konfigurasi.regseller')}}">Paket Reg Seller</a></li>
                                        <li><a href="{{route('admin.konfigurasi.hargaiklan')}}">Harga Iklan (Iklan Greenplaza)</a></li>
                                        <li><a href="{{route('admin.konfigurasi.hargabeli')}}">Harga Beli Saldo Iklan</a></li>
                                        {{-- <a href="#">Setting Harga</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Paket Reg Seller</a></li>
                                            <li><a href="#">Harga Iklan (Iklan Greenplaza)</a></li>
                                            <li><a href="#">Harga Beli Saldo Iklan</a></li>
                                        </ul> --}}
                                    </li> -->
                                    <li class="{{FunctionLib::setActive('admin/konfigurasi/iklan')}}">
                                        <h5 class="m-l-sm text-danger">Setting Iklan</h5>
                                        <!-- <li><a href="{{route('admin.konfigurasi.iklanslider')}}">Iklan Slider</a></li> -->
                                        <li><a href="{{route('admin.konfigurasi.iklanbanner')}}">Iklan Banner dan Slider</a></li>
                                        {{-- <a href="#">Setting Iklan</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Iklan Slider</a></li>
                                            <li><a href="#">Iklan Banner Khusus</a></li>
                                        </ul> --}}
                                    </li>
                                    <li class="{{FunctionLib::setActive('admin/config/transaction')}}">
                                        <h5 class="m-l-sm text-danger">Setting Transaksi</h5>
                                        <li><a href="{{route('admin.config.transaction')}}">Jeda Waktu Transaksi</a></li>
                                        <!-- <li><a href="#">Fee Transaksi</a></li>
                                        <li><a href="#">Pajak</a></li> -->
                                        {{-- <a href="#">Setting Transaksi</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('admin.config.transaction')}}">Jeda Waktu Transaksi</a></li>
                                            <li><a href="#">Fee Transaksi</a></li>
                                            <li><a href="#">Pajak</a></li>
                                        </ul> --}}
                                    </li>
                                    <li>
                                        <h5 class="m-l-sm text-danger">Profil Greenplaza</h5>
                                        <li class="{{FunctionLib::setActive('admin/config/profil')}}"><a href="{{route('admin.config.profil')}}">Profil Greenplaza</a></li>
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/officialemail')}}"><a href="{{route('admin.konfigurasi.officialemail')}}">Official Email</a></li>
                                        <li class="{{FunctionLib::setActive('admin/bank')}}"><a href="{{route('admin.bank.index')}}">Bank</a></li>
                                        {{-- <a href="#">Profil Greenplaza</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Profil Greenplaza</a></li>
                                            <li><a href="#">Official Email</a></li>
                                            <li><a href="{{route('admin.bank.index')}}">Bank</a></li>
                                        </ul> --}}
                                    </li>
                                    <li>
                                        <h5 class="m-l-sm text-danger">Setting Akun</h5>
                                        @if(Auth::user()->is_superadmin())
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/tambah_akunadmin')}}"><a href="{{route('admin.konfigurasi.akunadmin')}}">Tambah Akun Admin</a></li>
                                        @endif
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/set_shipment_admin')}}"><a href="{{route('admin.konfigurasi.set_shipment_admin')}}">Atur Kurir</a></li>
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/admin_address')}}"><a href="{{route('admin.konfigurasi.admin_address')}}">Atur Alamat</a></li>
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/grademember')}}"><a href="{{route('admin.konfigurasi.grademember')}}">Grade</a></li>
                                        <!-- <li><a href="#">Grade Seller</a></li> -->
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/pagelist')}}"><a href="{{route('admin.konfigurasi.pagelist')}}">Page List</a></li>
                                        <!-- <li><a href="{{route('admin.page')}}">Page List</a></li> -->
                                        <li class="{{FunctionLib::setActive('admin/konfigurasi/updatepassword')}}"><a href="{{route('admin.konfigurasi.updatepass')}}">Update Password Admin</a></li>
                                        {{-- <a href="#">Setting Akun</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Tambah Akun Admin</a></li>
                                            <li><a href="#">Grade Member</a></li>
                                            <li><a href="#">Grade Seller</a></li>
                                            <li><a href="#">Page List</a></li>
                                            <li><a href="#">Update Password Admin</a></li>
                                        </ul> --}}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->