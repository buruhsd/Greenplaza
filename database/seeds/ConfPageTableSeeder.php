<?php

use Illuminate\Database\Seeder;

class ConfPageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_page')->delete();
        
        \DB::table('conf_page')->insert(array (
            0 => 
            array (
                'id' => 1,
                'page_judul' => 'Cara Belanja',
                'page_role_id' => 0,
                'page_kategori' => 'member',
                'page_header_image' => 'cara_belanja.jpeg',
                'page_text' => '<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/1.png" style="height:312px; width:200px" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/2.png" style="height:274px; width:200px" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>

<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/3(1).png" style="height:224px; width:250px" />&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/4.png" style="height:260px; line-height:1.6em; width:220px" /> &nbsp; &nbsp; &nbsp;</p>

<p>&nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/5.png" style="height:251px; line-height:1.6em; width:200px" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/6.png" style="height:347px; line-height:1.6em; width:200px" />&nbsp;</p>

<p>&nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/7.png" style="height:236px; line-height:1.6em; width:200px" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt="" src="http://www.rejekimall.com/asset/img/page/images/8.png" style="height:238px; line-height:1.6em; width:300px" />&nbsp; &nbsp; &nbsp;</p>

<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/9.png" style="height:255px; line-height:1.6em; width:300px" /></p>
',
                'page_status' => 1,
                'page_slug' => 'cara-belanja',
                'created_at' => '2018-11-29 10:56:17',
                'updated_at' => '2018-11-29 10:56:20',
            ),
            1 => 
            array (
                'id' => 2,
                'page_judul' => 'Ketentuan Member',
                'page_role_id' => 0,
                'page_kategori' => 'member',
                'page_header_image' => 'ketentuan_member.jpeg',
                'page_text' => '<ol>
<li><strong>Definisi Member</strong></li>
</ol>

<p>Member adalah orang yang melakukan proses registrasi di greenplaza.com dengan memberikan &quot;Informasi Pribadi&quot; secara individual, juga mereka yang memberikan informasi secara continue untuk greenplaza.com, dan mereka yang diberikan wewenang untuk melakukan pembelian sesuai dengan kapasitasnya.</p>

<p>&nbsp;</p>

<ol start="2">
<li><strong>Registrasi Member</strong></li>
</ol>

<p><strong>Proses pendaftaran member</strong></p>

<p>Member ID : menggunakan username dan password.</p>

<p>Metode verifikasi:</p>

<ul>
<li>Verifikasi melalui email (URL Link) : greenplaza.com mengirimkan kode verifikasi ke email untuk memverifikasi akun.</li>
<li>Member yang tidak memverifikasi akun akan dianggap sebagai member non - aktif.</li>
<li>Member dapat melakukan proses pembelian di greenplaza.com</li>
</ul>

<p><strong>Informasi penting yang dibutuhkan untuk proses registrasi</strong></p>

<ul>
<li>Email</li>
<li>Password dan konfirmasinya</li>
<li>Nama jelas</li>
<li>Jenis kelamin</li>
<li>Kode Captcha untuk verifikasi</li>
<li>Konfirmasi persetujuan syarat dan ketentuan pengguna, kebijakan privasi dan perjanjian.</li>
<li>Transaksi keuangan elektronik</li>
<li>Tanggal lahir ( Tanggal / Bulan / Tahun )</li>
<li>Nomor phone cell.</li>
<li>Scan ID card/KTP.</li>
<li>Alamat lengkap.</li>
</ul>
',
                'page_status' => 1,
                'page_slug' => 'ketentuan-menjadi-member',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'page_judul' => 'Cara Beriklan',
                'page_role_id' => 0,
                'page_kategori' => 'seller',
                'page_header_image' => NULL,
                'page_text' => '<div class="row">
<div class="col-md-12">
<div class="six columns"><strong>Pengertian Iklan</strong></div>

<div class="six columns">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Iklan adalah suatu pesan tentang barang/jasa (produk) yang dibuat oleh produser/pemrakarsa yang disampaikan lewat media (cetak, audio, elektronik) yang ditujukan kepada masyarakat.</div>

<div class="six columns">&nbsp;</div>

<div class="six columns"><strong>Cara Beriklan</strong></div>

<div class="six columns">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Anda hanya perlu mendaftar terlebih dahulu menjadi seller/member di greenplaza.com. Setelah mempunyai akun menjadi seller/member di greenplaza.com maka secara otomatis dapat memasang iklan sesuai yang diinginkan hanya dengan masuk ke masing-masing menu dashboard dan order iklan, baik itu iklan banner atau iklan baris.</div>

<div class="six columns">&nbsp;</div>

<div class="six columns"><strong>Jenis Iklan dan tampilan di greenplaza.com</strong></div>

<ul>
<li>Iklan Banner adalah iklan yang ditampilkan dalam bentuk poster atau gambar dengan keterangan dan nama barang yang akan ditawarkan kepada masyarakat.</li>
</ul>

<p>Iklan banner akan tampil di Home greenplaza.com sehingga pengunjung website greenplaza.com bisa langsung melihat iklan yang ditawarkan, selain itu iklan banner akan berganti sesuai giliran. Jadi, tidak hanya seller saja yang bisa memasang iklan di home greenplaza.com, pembeli juga tetap bisa memasang iklan di greenplaza.com tentunya iklan tersebut dibuat semenarik mungkin untuk mendapatkan perhatian pengunjung website.</p>

<ul>
<li>Iklan Baris adalah iklan yang ditampilkan dalam bentuk tulisan yang berisi tentang kategori/spesifikasi barang atau jasa yang&nbsp;ditawarkan.</li>
</ul>

<p>Iklan baris akan ditampilkan dalam bentuk tulisan tentang kategori/spesifikasi barang/jasa yang ditawarkan. Iklan baris berisi tulisan singkat, padat, jelas serta harus mampu meyakinkan khalayak.</p>

<p style="margin-left:21.3pt">Iklan banner dan iklan baris dapat dihubungkan dengan etalase toko (seller) yang berisi barang/jasa yang diawarkan atau dapat dihubungkan dengan web di luar greenplaza.com dengan cara membeli pincode (poin yang digunakan untuk menghubungkan iklan dengan web yang dimiliki seller/member diluar web greenplaza.com) sehingga pengunjung leluasa untuk mengunjungi web seller/member yang dimiliki.</p>

<p style="margin-left:21.3pt"><strong style="line-height:1.6em">Keuntungan Beriklan di greenplaza.com</strong></p>

<ol>
<li>Akses mudah</li>
<li>Paket iklan murah dan menguntungkan</li>
<li>Akan dilihat oleh banyak pengunjung web greenplaza.com</li>
<li>Iklan akan meningkatkan penjualan produk di greenplaza.com</li>
<li>Iklan dapat diubah sewaktu-waktu, disesuaikan bahkan dihapus oleh member/seller itu sendiri</li>
<li>Akan ada pemberitahuan tentang masa aktif iklan</li>
</ol>

<p style="margin-left:21.3pt"><strong>Harga dan Paket Iklan </strong></p>

<ul>
<li>Iklan Banner : Rp. 250.000,-</li>
<li>Iklan Baris&nbsp;&nbsp; : Rp. 100.000,-</li>
</ul>

<p style="margin-left:21.3pt">Untuk yang mendaftar menjadi seller ada paket gratis berupa iklan banner dan iklan baris, yaitu :</p>

<ol>
<li>Paket Gold (Rp. 100.000,-) mendapatkan 1 iklan banner dan 5 iklan baris.</li>
<li>Paket Platinum (Rp. 150.000,-) mendapatkan 2 iklan banner dan 10 iklan baris.</li>
<li>Paket Titanium (Rp. 300.000,-) mendapatkan 5 iklan banner dan 25 iklan baris.</li>
</ol>
</div>
</div>
',
                'page_status' => 1,
                'page_slug' => 'cara-beriklan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'page_judul' => 'Cara Pembayaran',
                'page_role_id' => 0,
                'page_kategori' => 'member',
                'page_header_image' => 'cara_pembayaran.jpeg',
                'page_text' => '<h4>Pembayaran dengan Transfer</h4>

<ol>
<li>greenplaza.com menyediakan metode pembayaran dengan transfer ke rekening bank yang sudah di sediakan.</li>
<li>Setelah berhasil melakukan transfer, Anda wajib melakukan konfirmasi pembayaran dengan cara menekan Konfirmasi pada halaman&nbsp; <u>Konfirmasi Pembayaran</u></li>
<li>Lengkapi data pada <em>pop-up</em> konfirmasi pembayaran</li>
<li>Tekan &ldquo;Konfirmasi&rdquo;</li>
</ol>
',
                'page_status' => 1,
                'page_slug' => 'cara-melakukan-pembayaran',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'page_judul' => 'Aturan Penggunaan',
                'page_role_id' => 0,
                'page_kategori' => 'greenplaza',
                'page_header_image' => 'aturan_penggunaan.jpeg',
                'page_text' => '<p>Aturan penggunaan ini berlaku pada semua pengguna greenplaza.com baik terdaftar&nbsp;dalam greenplaza.com atau tidak. Aturan ini diperlukan untuk menjamin keamanan dan kenyamanan semua pihak. Dengan menggunakan situs greenplaza.com, pengguna&nbsp;greenplaza.com&nbsp;menyatakan setuju dengan peraturan dan ketentuan di bawah ini.&nbsp;</p>

<p>Anda setuju bahwa dengan menggunakan situs ini Anda menerima, menyetujui, tunduk, dan mematuhi syarat-syarat penggunaan ini, termasuk kebijakan privasi&nbsp;yang akan berlaku sesuai dengan cara penggunaan Anda baik sebagai penjual maupun pembeli.&nbsp;</p>

<p>Aturan Penggunaan ini adalah perjanjian penggunaan situs dan Anda menyatakan pengakuan Anda dan penerimaan tanpa syarat dari semua syarat, aturan, dan ketentuan didalamnya. Untuk menghindari keraguan, istilah &ldquo;produk&rdquo; dalam perjanjian ini dapat merujuk pada segala jenis paket layanan yang Anda terbitkan di situs kami. Untuk menghindari keraguan, istilah &quot;penjual&quot; dalam Perjanjian ini merujuk pada perusahaan Anda atau/dan Anda sendiri yang menawarkan produk.</p>

<p><strong>Informasi Apa Yang Kami Kumpulkan?</strong></p>

<p>greenplaza.com dapat mengumpulkan berbagai jenis informasi dari atau tentang Anda. Selama proses pendaftaran situs, Anda menyediakan kami dengan informasi kontak dasar (seperti nama, alamat, nomor telepon, alamat e-mail dan nama perusahaan) yang kami gunakan untuk tujuan menghubungi. Informasi ini umumnya dilakukan dalam bidang dalam formulir pendaftaran. Jika Anda menggunakan layanan greenplaza.com&nbsp;melalui situs, informasi yang Anda berikan saat proses pendaftaran dapat digunakan untuk melacak rincian tentang pembelian itu. Kami juga dapat mengumpulkan informasi mengenai sumber asal pengunjung, kegiatan mereka dan perilaku pembelian untuk penggunaan internal kami saja. Kami tidak mengumpulkan informasi dari pelanggan Anda. greenplaza.com tidak memiliki akses maupun kemampuan untuk menggunakan data pribadi yang dikumpulkan oleh aplikasi pihak ketiga e-commerce untuk&nbsp; link greenplaza.com. greenplaza.com bagaimanapun, gunakan anonim, data agregat untuk mengevaluasi efektivitas teknologi. greenplaza.com&nbsp;tidak bertanggung jawab atas data yang dikumpulkan oleh organisasi yang menggunakan pihak ketiga lainnya untuk menyelesaikan proses pemesanan.</p>

<p>&nbsp;</p>

<h6><strong>Jual barang</strong></h6>

<ol>
<li>Peenjual bertanggung jawab secara penuh atas segala resiko yang timbul di kemudian hari terkait dengan informasi yang dibuatnya, termasuk, namun tidak terbatas pada hal-hal yang berkaitan dengan hak cipta, merek, desain industri, desain tata letak sirkuit, hak paten dan/atau izin lain yang telah ditetapkan atas suatu produk menurut hukum yang berlaku di Indonesia.</li>
<li>Penjual hanya diperbolehkan menjual barang-barang yang tidak tercantum di daftar &ldquo;Barang Terlarang&rdquo;.</li>
<li>Penjual wajib menempatkan barang dagangan sesuai dengan kategori dan subkategorinya.</li>
<li>Penjual wajib mengisi nama barang/judul barang dengan jelas, singkat dan padat.</li>
<li>Penjual wajib menampilkan gambar barang yang sesuai dengan deskripsi barang yang dijual dan tidak mencantumkan logo ataupun alamat situs jual-beli lain pada gambar. dengan resolusi maksimal 1000px x 1000px.</li>
<li>Penjual wajib mengisi harga yang sesuai dengan harga sebenarnya.</li>
<li>Penjual tidak diperkenankan mencantumkan alamat (situs, forum, &amp; <em>social network</em>), nomor kontak, ID / PIN / username <em>social media</em>, dan nomor rekening bank selain pada kolom yang disediakan.</li>
<li>Penjual dilarang menjual barang yang identik sama (<em>multiple posting</em>) dengan yang sudah ada di lapaknya.</li>
<li>Pemberian informasi alamat (email, situs, forum, &amp; <em>social network</em>), nomor telepon, ID / PIN / <em>username social media</em> melalui pesan tidak diperbolehkan.</li>
<li>Penjual wajib memperbarui (<em>update</em>) ketersediaan dan status barang yang dijual.</li>
<li>Catatan Penjual diperuntukkan bagi penjual yang ingin memberikan catatan tambahan yang tidak terkait dengan deskripsi barang kepada calon pembeli. Catatan Penjual tetap tunduk terhadap Aturan Penggunaan GreenPlaza.</li>
<li>Penjual wajib mengirim barang pesanan menggunakan jasa pengiriman resmi yang dapat dilacak status pengirimannya.</li>
<li>Penjual dilarang membuat transaksi fiktif atau palsu demi kepentingan menaikkan feedback. GreenPlaza berhak mengambil tindakan seperti pemblokiran akun atau tindakan lainnya apabila ditemukan tindakan kecurangan.</li>
</ol>

<p><strong>Transaksi </strong></p>

<ol>
<li>Pembeli wajib mempelajari informasi virtual item terlebih dahulu sebelum memesan. Pembeli wajib membayar sejumlah harga virtual item yang telah dipesan dalam waktu 2x24 jam.</li>
<li>Jika dalam waktu 2x24 jam pembeli tidak membayar sejumlah harga virtual item yang telah dipesan, maka transaksi akan dibatalkan secara otomatis.</li>
<li>Jika terdapati transaksi gagal, maka dana pembeli yang digunakan untuk bertransaksi akan otomatis masuk kedalam CW Transaksi pengguna dan dapat digunakan untuk berbelanja kembali atau dicairkan ke rekening pembeli yang bersangkutan.</li>
<li>Pembeli wajib memberikan informasi data yang benar dalam melakukan pesanan.</li>
<li>Jika penjual tidak menyanggupi pengiriman dalam 3 hari dari pembayaran yang telah dibayar oleh pembeli, maka dana akan masuk ke CW Transaksi pembeli.</li>
<li>Penjual dapat mencairkan saldo hasil penjualannya dengan mengajukan proses widrawal ke rekening pribadi penjual. Proses tersebut berlangsung selama kurang lebih 1 hari kerja.</li>
<li>Sistem GreenPlaza secara otomatis memeriksa status pemesanan dan akan menunjukkan status pemesanan maupun proses transaksi kepada para penjual dan pembeli.</li>
<li>Jika pembeli tidak memberikan update terhadap transaksi yang sudah dia lakukan dalam 14 (empat belas) hari, GreenPlaza akan mentransfer dana langsung ke penjual tanpa konfirmasi kepada pembeli terlebih dahulu.</li>
<li>GreenPlaza akan menahan dana sampai akan adanya kesepakatan antara kedua belah pihak baik penjual dan pembeli jika terjadi salah paham antara penjual dan pembeli ataupun perselisihan pendapat dari pihak penjual dan pembeli.</li>
</ol>

<p style="margin-left:21.3pt">&nbsp;</p>

<p><strong>Mengunggah [upload] materi ke situs&nbsp;</strong><a href="https://www.greenplaza.com/"><strong>www.greenplaza.com</strong></a></p>

<ol>
<li>Bilamana Pengguna menggunakan fitur yang memungkinkan Pengguna mengunggah [upload] materi ke situs www.greenplaza.com dan atau untuk mengadakan hubungan dengan para pengguna lain dari situs www.greenplaza.com, maka Pengguna wajib memenuhi standar yang ditetapkan dalam kebijakan penggunaan sebagaimana diatur dalam Privacy Policy.</li>
<li>Pengguna berkewajiban untuk mengganti kerugian GreenPlaza apabila terjadi kerugian atas tidak dipatuhinya kebijakan Pengguna www.greenplaza.com, yang dilakukan oleh Pengguna baik secara sengaja ataupun tidak sengaja.</li>
<li>Setiap materi yang diunggah oleh Pengguna ke situs www.greenplaza.com akan dianggap materi yang tidak bersifat rahasia dan tidak dilindungi oleh hak kepemilikan dan GreenPlaza berhak menggunakan, menyalin, mengubah, menyebar-luaskan, termasuk tidak terbatas pada mengungkapkan materi tersebut kepada pihak ketiga untuk segala tujuan.</li>
<li>GreenPlaza berhak mengungkapkan identitas Pengguna kepada pihak ketiga yang mengklaim bahwa materi yang ditempatkan atau diunggah Pengguna ke situs www.greenplaza.com merupakan pelanggaran terhadap Hak Kekayaan Intelektual atau hak pribadi pihak ketiga, sesuai peraturan yang berlaku di Indonesia.</li>
<li>GreenPlaza berhak menghapus dan atau mengubah isi, materi atau bagian lain dari iklan, baik sebagian maupun keseluruhan, yang dipasang Pengguna di situs www.greenplaza.com tanpa pemberitahuan terlebih dahulu kepada Pengguna, termasuk tapi tidak terbatas apabila hal itu bersifat sensitif, ofensif, dapat memicu kebencian, mencemarkan nama baik, memuat materi yang memicu perpecahan suku, agama, ras, antar golongan, pornografi, perjudian, ataupun bertentangan dengan norma etika kesusilaan dan hukum yang berlaku di Republik Indonesia serta tidak sejalan dengan arahan bisnis greenplaza.com.</li>
</ol>

<p>&nbsp;</p>

<p><strong>Tautan dari situs&nbsp;</strong><a href="https://www.greenplaza.com/"><strong>www.greenplaza.com</strong></a></p>

<ol>
<li>Situs www.greenplaza.com dapat mengandung tautan ke situs dan atau sumberdaya lain yang disediakan oleh pihak ketiga, dimana GreenPlaza menegaskan bahwa tautan tersebut disediakan hanya sebagai informasi bagi Pengguna. GreenPlaza melepaskan diri dari kewajiban atas mengontrol isi dari situs atau sumberdaya yang terjadi karena tautan (hyperlink) yang ada di situs www.greenplaza.com.</li>
<li>GreenPlaza tidak bertanggung jawab atas kehilangan dan atau kerugian yang dapat timbul akibat penggunaannya.</li>
<li>Syarat &amp; Ketentuan Layanan situs www.greenplaza.com ini dan hubungan Pengguna dengan GreenPlaza tunduk, diatur dan patuh menurut hukum Republik Indonesia, dan Pengguna sepakat untuk terikat pada yurisdiksi hukum Republik Indonesia.<br />
Perubahan-perubahan</li>
<li>GreenPlaza dapat sewaktu-waktu merubah Syarat &amp; Ketentuan Layanan GreenPlaza ini tanpa pemberitahuan terlebih dahulu dan karenanya, Pengguna diharapkan membaca terlebih dahulu Syarat &amp; Ketentuan Layanan GreenPlaza sebelum melakukan Aktivitas. Dengan melakukan Aktivitas melalui Layanan GreenPlaza ini, Pengguna menyatakan setuju untuk tunduk dan terikat pada Ketentuan Layanan GreenPlaza.</li>
<li>Pengguna diharapkan untuk memeriksa halaman ini dari waktu ke waktu untuk memperhatikan setiap perubahan, karena hal tersebut mengikat Pengguna.</li>
<li>Sebagian dari ketentuan yang terdapat dalam Syarat &amp; Ketentuan Layanan GreenPlaza ini dapat digantikan oleh ketentuan-ketentuan atau pemberitahuan lain yang dipublikasi di bagian lain di situs www.greenplaza.com.<br />
Lain-Lain</li>
<li>Apabila terjadi perselisihan dalam penafsiran dan pelaksanaan Syarat &amp; Ketentuan Layanan GreenPlaza, GreenPlaza dan Pengguna sepakat untuk menyelesaikannya secara musyawarah untuk mufakat.</li>
<li>Apabila Pengguna memiliki hal lain yang ingin disampaikan atau komentar maupun keprihatinan mengenai materi yang tampak di situs www.greenplaza.com, silakan hubungi info@greenplaza.com.<br />
<br />
Terima kasih atas kunjungan anda ke situs&nbsp;<a href="https://www.greenplaza.com/">www.greenplaza.com</a><br />
<br />
Salam Greenplaza</li>
</ol>
',
                'page_status' => 1,
                'page_slug' => 'aturan-penggunaan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'page_judul' => 'Syarat & Ketentuan',
                'page_role_id' => 0,
                'page_kategori' => 'greenplaza',
                'page_header_image' => 'syarat_dan_ketentuan.jpeg',
                'page_text' => '<h1>Syarat &amp; Ketentuan</h1>

<div class="terms-privacy-content">
<div class="terms-privacy-content">
<div>
<p>greenplaza.com melindungi segala informasi yang diberikan pengguna pada saat pendaftaran, mengakses, dan menggunakan seluruh layanan greenplaza.com.</p>
</div>
</div>
</div>

<ul>
<li>greenplaza.com berhak menggunakan data dan informasi para pengguna situs demi meningkatkan mutu dan pelayanan di greenplaza.com.</li>
<li>greenplaza.com hanya dapat memberitahukan data dan informasi yang dimiliki oleh para pengguna situs bila diwajibkan dan/atau diminta oleh institusi yang berwenang berdasarkan ketentuan hukum yang berlaku, perintah resmi dari pengadilan, dan/atau perintah resmi dari instansi/aparat yang bersangkutan.</li>
<li>Pengguna situs GreenPlaza dapat berhenti berlangganan beragam informasi promo terbaru dan penawaran eksklusif (<em>unsubsribe</em>) jika tidak ingin menerima informasi tersebut.</li>
</ul>
',
                'page_status' => 1,
                'page_slug' => 'syarat-ketentuan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'page_judul' => 'Keuntungan',
                'page_role_id' => 0,
                'page_kategori' => 'seller',
                'page_header_image' => NULL,
                'page_text' => '<div class="slider-generic__content">
<ul>
<li><strong>Feedback positif setiap transaksi sukses</strong></li>
</ul>

<p style="margin-left:35.45pt">Penjual akan mendapatkan feedback positif secara otomatis dari sistem walaupun pembeli tidak memberikan feedback saat transaksi.</p>

<ul>
<li><strong>Kepastian menerima uang pembayaran</strong></li>
</ul>

<p style="margin-left:1.0cm">&nbsp;Penjual langsung menerima uang pembayaran setelah pembeli mengkonfirmasi penerimaan barang atau 1&times;24 jam setelah barang terkirim menurut kurir.</p>

<ul>
<li><strong>Bonus Penjual Get Penjual</strong></li>
</ul>

<p style="margin-left:1.0cm">&nbsp;Penjual akan mendapatkan Rp. 50,00 apabila dapat menyeponsori penjual yang lain</p>

<p style="margin-left:1.0cm">&nbsp;Penjual akan&nbsp;mendapatkan Rp. 10,00 setiap seller yang disponsori melakukan transaksi hingga kedalaman 10 generasi</p>

<ul>
<li><strong>Bonus Bermain Cakragames</strong></li>
</ul>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Penjual yang membeli saldo iklan akan mendapatkan poin untuk bermain games d Cakragames sesuai dengan paket saldo iklan yang dibeli</p>

<ul>
<li><strong>Perhitungan Ongkos Kirim Otomatis</strong></li>
</ul>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Penjual tidak perlu repot menghitung ongkos kirim karena sistem akan otomatis menghitung ongkos kirim yang harus dibayar oleh pembeli</p>

<p>&nbsp;</p>
</div>
',
                'page_status' => 1,
                'page_slug' => 'keuntungan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'page_judul' => 'Alur Transaksi',
                'page_role_id' => 0,
                'page_kategori' => 'greenplaza',
                'page_header_image' => 'alur_transaksi.jpeg',
                'page_text' => '<p><img alt="Alur transaksi" class="example1" src="../../asset/img/alur-transaksi.jpg" style="height:auto; min-width:100%" /></p>
',
                'page_status' => 1,
                'page_slug' => 'alur-transaksi',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'page_judul' => 'Cara Berjualan',
                'page_role_id' => 0,
                'page_kategori' => 'seller',
                'page_header_image' => NULL,
                'page_text' => '<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/10.png" style="height:232px; width:225px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img alt="" src="http://www.rejekimall.com/asset/img/page/images/11.png" style="height:347px; width:225px" /></p>

<p>&nbsp;</p>

<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/12.png" style="height:199px; width:225px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img alt="" src="http://www.rejekimall.com/asset/img/page/images/13.png" style="height:181px; width:225px" /></p>

<p>&nbsp;</p>

<p><img alt="" src="http://www.rejekimall.com/asset/img/page/images/14.png" style="height:202px; width:225px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img alt="" src="http://www.rejekimall.com/asset/img/page/images/15.png" style="width:225px" /></p>
',
                'page_status' => 1,
                'page_slug' => 'cara-berjualan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'page_judul' => 'Ketentuan & Privasi kami',
                'page_role_id' => 0,
                'page_kategori' => 'greenplaza',
                'page_header_image' => NULL,
                'page_text' => 'Ketentuan & Privasi kami.',
                'page_status' => 1,
                'page_slug' => 'ketentuan-&-privasi-kami',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}