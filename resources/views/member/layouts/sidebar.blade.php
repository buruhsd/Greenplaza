
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="{{route('member.home')}}">
                    <span>Greenplaza</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="{{route('member.dashboard')}}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-bar-chart-o"></i><span>Sales</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('member.transaction.sales')}}">Transaction</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Resolusi Komplain</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-shopping-bag"></i><span>Purchase</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('member.transaction.purchase')}}">Transaction</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Resolusi Komplain</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">Wishlist</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Get Penjual</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Sponsor</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Register Penjual</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">History Saldo</a></li>
                                    <li><a href="{{-- {{route('member.Withdrawal.create')}} --}}">Withdrawal</a></li>
                                    <li><a href="{{-- {{route('member.cw.index')}} --}}">Transfer CW</a></li>
                                    <li><a href="{{-- {{route('member.rw.index')}} --}}">Transfer RW</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Pengaturan Profil</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <h4 class="m-l-sm text-danger">Seller</h4>
                                    <li><a href="{{route('member.profil')}}">Profil Anda</a></li>
                                    <li><a href="{{route('member.user.change_password')}}">Ubah Password Login</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">Ubah Password Transaksi</a></li>
                                    <li><a href="{{route('member.user.seller_address')}}">Alamat Seller</a></li>
                                    <li><a href="{{route('member.user.upload_foto_profil')}}">Upload Foto Profil</a></li>
                                    <li><a href="{{route('member.user.upload_scan_npwp')}}">Upload Scan NPWP</a></li>
                                    <li><a href="{{route('member.user.upload_siup')}}">Upload Scan SIUP/TDP</a></li>

                                    <h4 class="m-l-sm text-danger">Buyer</h4>
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Biodata</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Alamat Kirim</a></li>
                                    <li><a href="{{route('member.bank.index')}}">Rekening Bank</a></li>
                                    <li><a href="{{-- {{route('member.Withdrawal.create')}} --}}">Ubah Password Login</a></li>
                                    <li><a href="{{-- {{route('member.cw.index')}} --}}">Ubah Password Transaksi</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Pesan & Diskusi</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('member.message.index')}}">Pesan</a></li>
                                    <li><a href="{{-- {{route('member.produk_discuss.index')}} --}}">Diskusi Produk</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Produk & Brand</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('member.produk.index')}}">Daftar Produk</a></li>
                                    <li><a href="{{route('member.brand.index')}}">Daftar Brand</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Hot List</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Buy Poin Hot List</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Tagihan Hot List</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">History Hot List Produk</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>PIN Code</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Beli Pin Kode</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Tagihan Pin Kode</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">Daftar Pin Kode</a></li>
                                </ul>
                            </li>
                            {{-- need actived --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Pasang Iklan</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Beli Saldo Iklan></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Tagihan Iklan</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">Iklan Baris</a></li>
                                    <li><a href="{{-- {{route('member.Withdrawal.create')}} --}}">Iklan Banner</a></li>
                                    <li><a href="{{-- {{route('member.cw.index')}} --}}">Iklan Banner Khusus</a></li>
                                    <li><a href="{{-- {{route('member.rw.index')}} --}}">History Iklan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('member.user.set_shipment')}}">
                                    <i class="menu-icon icon-layers"></i><span>Atur Kurir</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                            </li>
                            {{-- need actived --}}
                            {{-- pembeli --}}
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-shopping-bag"></i><span>Log</span><i class="ion-android-arrow-dropdown-circle right"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{-- {{route('member.sponsor.index')}} --}}">Log Cw Transaksi</a></li>
                                    <li><a href="{{-- {{route('member.sponsor.register')}} --}}">Log Cw Bonus</a></li>
                                    <li><a href="{{-- {{route('member.log_saldo.index')}} --}}">Log Saldo Iklan</a></li>
                                    <li><a href="{{-- {{route('member.Withdrawal.create')}} --}}">Log Aktifitas</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->