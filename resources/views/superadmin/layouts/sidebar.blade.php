
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="index.html">
                    <span>Greenplaza</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="{{route('admin.dashboard')}}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.live_chat')}}">
                                    <i class="menu-icon icon-voice_chat"></i><span>Live Chat</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.email_sender')}}">
                                    <i class="menu-icon icon-inbox"></i><span>Email Sender</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.resolusi_komplain')}}">
                                    <i class="menu-icon icon-inbox"></i><span>Resolusi Komplain</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.hot_promo')}}">
                                    <i class="menu-icon icon-fire"></i><span>Hot Promo</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-live_tv"></i><span>Monitoring</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="#">Laporan</a></li>
                                    <li><a href="#">Profit</a></li>
                                    <li><a href="#">Wallet</a></li>
                                    <li><a href="#">Wallet Pin Code</a></li>
                                    <li><a href="#">Wallet Saldo Iklan</a></li>
                                    <li><a href="#">Log Aktivitas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Need Approval</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('admin.transaction.index')}}">Transaksi Barang</a></li>
                                    <li><a href="#">Transaksi Hot List</a></li>
                                    <li><a href="#">Transaksi Pin Code</a></li>
                                    <li><a href="#">Akun Member</a></li>
                                    <li><a href="{{route('admin.brand.index')}}">Brand</a></li>
                                    <li><a href="#">Iklan Banner Khusus</a></li>
                                    <li><a href="#">Iklan Banner Seller</a></li>
                                    <li><a href="#">Iklan Baris Seller</a></li>
                                    <li><a href="#">Iklan Banner Pembeli</a></li>
                                    <li><a href="#">Iklan Baris Pembeli</a></li>
                                    <li><a href="{{route('admin.produk.index')}}">Produk</a></li>
                                    <li><a href="#">Request Saldo Iklan</a></li>
                                    <li><a href="#">Withdrawal Seller</a></li>
                                    <li><a href="#">Withdrawal Member</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-cog"></i><span>Konfigurasi</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="#">Setting Produk</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('admin.category.index')}}">Kategori Produk</a></li>
                                        </ul></li>
                                    <li><a href="#">Setting Harga</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Paket Reg Seller</a></li>
                                            <li><a href="#">Harga Iklan (Iklan Greenplaza)</a></li>
                                            <li><a href="#">Harga Beli Saldo Iklan</a></li>
                                        </ul></li>
                                    <li><a href="#">Setting Iklan</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Iklan Slider</a></li>
                                            <li><a href="#">Iklan Banner Khusus</a></li>
                                        </ul></li>
                                    <li><a href="#">Setting Transaksi</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Jeda Waktu Transaksi</a></li>
                                            <li><a href="#">Fee Transaksi</a></li>
                                            <li><a href="#">Pajak</a></li>
                                        </ul></li>
                                    <li><a href="#">Profil Greenplaza</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Profil Greenplaza</a></li>
                                            <li><a href="#">Official Email</a></li>
                                            <li><a href="{{route('admin.bank.index')}}">Bank</a></li>
                                        </ul></li>
                                    <li><a href="#">Setting Akun</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Tambah Akun Admin</a></li>
                                            <li><a href="#">Grade Member</a></li>
                                            <li><a href="#">Grade Seller</a></li>
                                            <li><a href="#">Page List</a></li>
                                            <li><a href="#">Update Password Admin</a></li>
                                        </ul></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->