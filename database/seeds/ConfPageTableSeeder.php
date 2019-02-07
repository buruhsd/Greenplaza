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
                'page_role_id' => 2,
                'page_kategori' => 'member',
                'page_header_image' => 'ketentuan_member.jpeg',
                'page_text' => '<ol>
<li><strong>Definisi Member</strong></li>
</ol>

<p>Member adalah orang yang melakukan proses registrasi di greenplaza.com dengan memberikan &quot;Informasi Pribadi&quot; secara individual, juga mereka yang memberikan informasi secara continue untuk greenplaza.com, dan mereka yang diberikan wewenang untuk melakukan pembelian sesuai dengan kapasitasnya.</p>

<p>&nbsp;</p>

<ol>
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
</ul>',
                'page_status' => 1,
                'page_slug' => 'ketentuan-member',
                'created_at' => NULL,
                'updated_at' => '2019-02-01 18:05:05',
            ),
            2 => 
            array (
                'id' => 3,
                'page_judul' => 'Cara Beriklan',
                'page_role_id' => 2,
                'page_kategori' => 'seller',
                'page_header_image' => NULL,
                'page_text' => '<p><strong>Pengertian Iklan</strong></p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Iklan adalah suatu pesan tentang barang/jasa (produk) yang dibuat oleh produser/pemrakarsa yang disampaikan lewat media (cetak, audio, elektronik) yang ditujukan kepada masyarakat.</p>

<p>&nbsp;</p>

<p><strong>Cara Beriklan</strong></p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Anda hanya perlu mendaftar terlebih dahulu menjadi seller/member di greenplaza.com. Setelah mempunyai akun menjadi seller/member di greenplaza.com maka secara otomatis dapat memasang iklan sesuai yang diinginkan hanya dengan masuk ke masing-masing menu dashboard dan order iklan, baik itu iklan banner atau iklan baris.</p>

<p>&nbsp;</p>

<p><strong>Jenis Iklan dan tampilan di greenplaza.com</strong></p>

<ul>
<li>Iklan Banner adalah iklan yang ditampilkan dalam bentuk poster atau gambar dengan keterangan dan nama barang yang akan ditawarkan kepada masyarakat.</li>
</ul>

<p>Iklan banner akan tampil di Home greenplaza.com sehingga pengunjung website greenplaza.com bisa langsung melihat iklan yang ditawarkan, selain itu iklan banner akan berganti sesuai giliran. Jadi, tidak hanya seller saja yang bisa memasang iklan di home greenplaza.com, pembeli juga tetap bisa memasang iklan di greenplaza.com tentunya iklan tersebut dibuat semenarik mungkin untuk mendapatkan perhatian pengunjung website.</p>

<ul>
<li>Iklan Baris adalah iklan yang ditampilkan dalam bentuk tulisan yang berisi tentang kategori/spesifikasi barang atau jasa yang&nbsp;ditawarkan.</li>
</ul>

<p>Iklan baris akan ditampilkan dalam bentuk tulisan tentang kategori/spesifikasi barang/jasa yang ditawarkan. Iklan baris berisi tulisan singkat, padat, jelas serta harus mampu meyakinkan khalayak.</p>

<p>Iklan banner dan iklan baris dapat dihubungkan dengan etalase toko (seller) yang berisi barang/jasa yang diawarkan atau dapat dihubungkan dengan web di luar greenplaza.com dengan cara membeli pincode (poin yang digunakan untuk menghubungkan iklan dengan web yang dimiliki seller/member diluar web greenplaza.com) sehingga pengunjung leluasa untuk mengunjungi web seller/member yang dimiliki.</p>

<p><strong>Keuntungan Beriklan di greenplaza.com</strong></p>

<ol>
<li>Akses mudah</li>
<li>Paket iklan murah dan menguntungkan</li>
<li>Akan dilihat oleh banyak pengunjung web greenplaza.com</li>
<li>Iklan akan meningkatkan penjualan produk di greenplaza.com</li>
<li>Iklan dapat diubah sewaktu-waktu, disesuaikan bahkan dihapus oleh member/seller itu sendiri</li>
<li>Akan ada pemberitahuan tentang masa aktif iklan</li>
</ol>

<p><strong>Harga dan Paket Iklan </strong></p>

<ul>
<li>Iklan Banner : Rp. 250.000,-</li>
<li>Iklan Baris&nbsp;&nbsp; : Rp. 100.000,-</li>
</ul>

<p>Untuk yang mendaftar menjadi seller ada paket gratis berupa iklan banner dan iklan baris, yaitu :</p>

<ol>
<li>Paket Gold (Rp. 100.000,-) mendapatkan 1 iklan banner dan 5 iklan baris.</li>
<li>Paket Platinum (Rp. 150.000,-) mendapatkan 2 iklan banner dan 10 iklan baris.</li>
<li>Paket Titanium (Rp. 300.000,-) mendapatkan 5 iklan banner dan 25 iklan baris.</li>
</ol>',
                'page_status' => 1,
                'page_slug' => 'cara-beriklan',
                'created_at' => NULL,
                'updated_at' => '2019-02-01 18:05:33',
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
                'page_judul' => 'TRANSAKSI',
                'page_role_id' => 2,
                'page_kategori' => 'greenplaza',
                'page_header_image' => 'alur_transaksi.jpeg',
                'page_text' => '<p>&nbsp;</p>

<p><tt>Transaksi</tt></p>

<ol>
<li>
<p><tt>Demi keamanan dan kenyamanan para Pengguna, setiap transaksi jual-beli di GreenPlaza diwajibkan untuk menggunakan GreenPlaza Payment System. Untuk informasi mengenai penggunaan GreenPlaza Payment System dapat dipelajari di <a href="https://panduan.bukalapak.com/">Panduan GreenPlaza</a>.</tt></p>
</li>
<li>
<p><tt>Pembeli wajib transfer sesuai dengan nominal total belanja dari transaksi dalam waktu 1x10 jam (dengan asumsi Pembeli telah mempelajari informasi barang yang telah dipesannya). Jika dalam waktu 1x24 jam barang dipesan tetapi Pembeli tidak mentransfer dana maka transaksi akan dibatalkan secara otomatis.</tt></p>
</li>
<li>
<p><tt>Setiap transaksi di GreenPlaza yang menggunakan metode transfer akan dikenakan biaya operasional dalam bentuk kode unik pembayaran yang ditanggung oleh Pembeli.</tt></p>
</li>
<li>
<p><tt>Pembeli tidak dapat membatalkan transaksi setelah melunasi pembayaran.</tt></p>
</li>
<li>
<p><tt>Jika penjual tidak menentukan waktu kirim barang pada setiap produknya, maka penjual wajib mengirimkan barang dalam waktu 3x24 jam di hari kerja (untuk biaya pengiriman reguler) atau 2x24 jam (untuk biaya pengiriman kilat) setelah status transaksi &ldquo;Dibayar&rdquo;. Untuk informasi <em>Atur Waktu Kirim</em> silakan <a href="https://www.bukalapak.com/bantuan/sebagai-pelapak/kelola-barang-dijual/cara-atur-waktu">klik di sini.</a></tt></p>
</li>
<li>
<p><tt>penjual dianggap telah menolak pesanan jika penjual tidak dapat mengirimkan barang dalam batas waktu yang telah ditentukan pada poin ke-5, penjual melakukan tolak pesanan secara langsung, atau mengabaikan transaksi. Sehingga sistem secara otomatis memberikan <em>feedback</em> negatif dan reputasi tolak pesanan, serta mengembalikan seluruh dana (<em>refund</em>) ke Pembeli.</tt></p>
</li>
<li>
<p><tt>penjual wajib mengirimkan barang dan mendaftarkan nomor resi pengiriman yang benar dan asli setelah status transaksi &ldquo;Dibayar&rdquo;. Satu nomor resi hanya berlaku untuk satu nomor transaksi di GreenPlaza.</tt></p>
</li>
<li>
<p><tt>Sistem GreenPlaza secara otomatis mengecek status pengiriman barang melalui nomor resi yang diberikan penjual. Apabila nomor resi terdeteksi tidak valid dan penjual tidak melakukan ubah resi valid dalam 1x24 jam maka seluruh dana akan dikembalikan ke Pembeli. Jika penjual memasukkan nomor resi tidak valid lebih dari satu kali maka GreenPlaza akan mengembalikan seluruh dana transaksi kepada Pembeli dan penjual mendapatkan <em>feedback</em> negatif.</tt></p>
</li>
<li>
<p><tt>Jika Pembeli tidak memberikan konfirmasi penerimaan barang dalam waktu 3x24 jam sejak status resi pengiriman dinyatakan telah diterima/delivered oleh sistem <em>tracking</em> jasa pengiriman, GreenPlaza akan mentransfer dana langsung ke cashwallet penjual tanpa memberikan konfirmasi ke Pembeli.</tt></p>
</li>
<li>
<p><tt>Sistem secara otomatis memberikan <em>feedback</em> (rekomendasi) positif dan mentransfer dana pembayaran ke cashwallet penjual jika status resi menunjukkan &lsquo;Barang diterima&rsquo; dan Pembeli telah melewati batas waktu untuk konfirmasi.</tt></p>
</li>
<li>
<p><tt>Pembeli dapat memperbarui <em>feedback</em> maksimal 3x24 jam setelah transaksi dinyatakan selesai oleh sistem GreenPlaza.</tt></p>
</li>
<li>
<p><tt>Retur <strong>(Pengembalian Barang)</strong> hanya diperbolehkan jika kesalahan dilakukan oleh penjual dan barang tidak sesuai deskripsi.</tt></p>
</li>
<li>
<p><tt>Retur tidak dapat dilakukan setelah transaksi selesai menurut sistem general tracking GreenPlaza atau Pembeli telah melakukan konfirmasi barang diterima dan tidak memilih retur.</tt></p>
</li>
<li>
<p><tt>Langkah-langkah dalam melakukan pengembalian barang dapat dibaca pada <a href="https://www.bukalapak.com/bantuan/category/sebagai-pembeli/retur">halaman ini</a></tt></p>
</li>
<li>
<p><tt>GreenPlaza akan menahan dana hingga ada kesepakatan antara Pembeli dan penjual apakah Pembeli akan mengembalikan barang ke penjual atau tidak.</tt></p>
</li>
<li>
<p><tt>GreenPlaza akan mengembalikan dana transaksi ke Pembeli jika <strong>dalam waktu 3x24</strong> jam penjual tidak merespon pesan permintaan retur dari Pembeli di halaman Diskusi Komplain. Selanjutnya, Pembeli wajib mengirimkan barang tersebut ke kantor GreenPlaza.</tt></p>
</li>
<li>
<p><tt>GreenPlaza tidak bertanggung jawab terhadap barang retur di kantor GreenPlaza apabila penjual tidak melakukan pengaduan kepemilikan barang dalam waktu 30 hari sejak barang diterima di kantor GreenPlaza.</tt></p>
</li>
<li>
<p><tt>Pembeli wajib mengirimkan barang ke penjual dan menginformasikan nomor resi ke GreenPlaza jika ada kesepakatan retur dengan penjual.</tt></p>
</li>
<li>
<p><tt>GreenPlaza hanya memantau retur sampai barang diterima kembali oleh penjual.</tt></p>
</li>
<li>
<p><tt>GreenPlaza berhak melakukan <em>refund</em> dana ke Pembeli jika barang retur telah sampai di kantor GreenPlaza dan berdasarkan pengecekan sesuai dengan yang dikeluhkan Pembeli.</tt></p>
</li>
<li>
<p><tt>penjual mendapatkan sanksi berupa pembekuan akun jika performa lapak dianggap di bawah standar GreenPlaza.</tt></p>
</li>
<li>
<p><tt>GreenPlaza atas kebijakannya sendiri dapat melakukan penahanan atau pembekuan cashwallet untuk melakukan perlindungan terhadap segala risiko dan kerugian yang timbul, jika GreenPlaza menyimpulkan bahwa tindakan Pengguna, baik penjual maupun Pembeli terindikasi melakukan kecurangan-kecurangan atau penyalahgunaan dalam bertransaksi dan/atau pelanggaran terhadap Aturan Penggunaan GreenPlaza dan jika akun Pengguna diduga atau terindikasi telah diakses oleh pihak lain.</tt></p>
</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>',
                'page_status' => 1,
                'page_slug' => 'transaksi',
                'created_at' => NULL,
                'updated_at' => '2019-01-29 09:24:03',
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
                'page_header_image' => 'kebijakan.png',
                'page_text' => '<h4>Kebijakan Privasi</h4><br />
<p>Kebijakan privasi yang dimaksud di GreenPlaza adalah acuan yang mengatur dan melindungi penggunaan data dan informasi penting para Pengguna GreenPlaza. Data dan informasi yang telah dikumpulkan pada saat mendaftar, mengakses, dan menggunakan layanan di GreenPlaza, seperti alamat, nomor kontak, alamat e-mail, foto, gambar, dan lain-lain.</p>

<h4>Kebijakan-kebijakan tersebut di antaranya:</h4>

<p>GreenPlaza tunduk terhadap kebijakan perlindungan data pribadi Pengguna sebagaimana yang diatur dalam Peraturan Menteri Komunikasi dan Informatika Nomor 20 Tahun 2016 Tentang Perlindungan Data Pribadi Dalam Sistem Elektronik yang mengatur dan melindungi penggunaan data dan informasi penting para Pengguna.</p>

<ol>
<li>GreenPlaza melindungi segala informasi yang diberikan Pengguna pada saat pendaftaran, mengakses, dan menggunakan seluruh layanan GreenPlaza.</li><br />

<li>GreenPlaza melindungi segala hak pribadi yang muncul atas informasi mengenai suatu produk yang ditampilkan oleh pengguna layanan GreenPlaza, baik berupa foto, username, logo, dan lain-lain.</li><br />

<li>GreenPlaza berhak menggunakan data dan informasi para Pengguna demi meningkatkan mutu dan pelayanan di GreenPlaza.</li><br />

<li>GreenPlaza tidak bertanggung jawab atas pertukaran data yang dilakukan sendiri di antara Pengguna.</li><br />

<li>GreenPlaza hanya dapat memberitahukan data dan informasi yang dimiliki oleh para Pengguna bila diwajibkan dan/atau diminta oleh institusi yang berwenang berdasarkan ketentuan hukum yang berlaku, perintah resmi dari Pengadilan, dan/atau perintah resmi dari instansi atau aparat yang bersangkutan.</li><br />

<li>Pengguna situs GreenPlaza dapat berhenti berlangganan (unsubscribe) beragam informasi promo terbaru dan penawaran eksklusif jika tidak ingin menerima informasi tersebut.</li><br />

</ol>',
                'page_status' => 1,
                'page_slug' => 'ketentuan-&-privasi-kami',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'page_judul' => 'Term and condition',
                'page_role_id' => 0,
                'page_kategori' => 'aboutus',
                'page_header_image' => NULL,
                'page_text' => '<h3><center>Informasi Umum</center></h3>

<p> </p>

<ul>
<li>GreenPlaza tidak bertanggung jawab atas kualitas barang, proses pengiriman, rusaknya reputasi pihak lain, dan atau segala bentuk perselisihan yang dapat terjadi antar Pengguna.</li>
<li>GreenPlaza memiliki kewenangan untuk mengambil tindakan yang dianggap perlu terhadap akun yang diduga dan atau terindikasi melakukan penyalahgunaan, memanipulasi, dan atau melanggar Aturan Penggunaan di GreenPlaza, mulai dari melakukan moderasi, menghentikan layanan penjualan, membatasi jumlah pembuatan akun, membatasi atau mengakhiri hak setiap Pengguna untuk menggunakan layanan, maupun menutup akun tersebut tanpa memberikan pemberitahuan atau informasi terlebih dahulu kepada pemilik akun yang bersangkutan.</li>
<li>GreenPlaza memiliki kewenangan untuk mengambil keputusan atas permasalahan yang terjadi pada setiap transaksi.</li>
<li>Jika Pengguna gagal untuk mematuhi setiap ketentuan dalam Aturan Penggunaan di GreenPlaza ini, maka GreenPlaza berhak untuk mengambil tindakan yang dianggap perlu</li>
<li>GreenPlaza <em>Payment System</em> bersifat mengikat Pengguna GreenPlaza dan hanya menjamin dana Pembeli tetap aman jika proses transaksi dilakukan dengan penjual yang terdaftar di dalam sistem GreenPlaza. Kerugian yang diakibatkan keterlibatan pihak lain di luar Pembeli, penjual, dan GreenPlaza, tidak menjadi tanggung jawab GreenPlaza.</li>
<li>GreenPlaza berhak meminta data-data pribadi Pengguna jika diperlukan.</li>
<li>Aturan Penggunaan GreenPlaza dapat berubah sewaktu-waktu dan/atau diperbaharui dari waktu ke waktu tanpa pemberitahuan terlebih dahulu. Dengan mengakses GreenPlaza, Pengguna dianggap menyetujui perubahan-perubahan dalam Aturan Penggunaan GreenPlaza.</li>
<li>Hati-hati terhadap penipuan yang mengatasnamakan GreenPlaza.</li>
</ul>

<p> </p>

<h3>Pengguna</h3>

<ol>
<li>Pengguna wajib mengisi data pribadi secara lengkap di halaman akun (profil).</li>
<li>Pengguna dilarang mencantumkan alamat, nomor kontak, alamat e-mail,  dan <em>username</em> , ,nama toko, dan deskripsi toko.</li>
<li>Pengguna bertanggung jawab atas keamanan dari akun termasuk penggunaan e-mail dan password.</li>
<li>Pengguna wajib mengisi data rekening bank untuk kepentingan bertransaksi di GreenPlaza.</li>
<li>Penggunaan fasilitas apapun yang disediakan oleh GreenPlaza mengindikasikan bahwa Pengguna telah memahami dan menyetujui segala aturan yang diberlakukan oleh GreenPlaza.</li>
<li>Selama berada dalam platform GreenPlaza, Pengguna dilarang keras menyampaikan setiap jenis konten apapun yang menyesatkan, memfitnah, atau mencemarkan nama baik, mengandung atau bersinggungan dengan unsur SARA, diskriminasi, dan atau menyudutkan pihak lain.</li>
<li>Pengguna tidak diperbolehkan menggunakan GreenPlaza untuk melanggar peraturan yang ditetapkan oleh hukum di Indonesia maupun di negara lainnya.</li>
<li>Pengguna bertanggung jawab atas segala risiko yang timbul di kemudian hari atas informasi yang diberikannya ke dalam GreenPlaza, termasuk namun tidak terbatas pada hal-hal yang berkaitan dengan hak cipta, merek, desain industri, desain tata letak industri dan hak paten atas suatu produk.</li>
<li>Pengguna diwajibkan menghargai hak-hak Pengguna lainnya dengan tidak memberikan informasi pribadi ke pihak lain tanpa izin pihak yang bersangkutan.</li>
<li>Pengguna tidak diperkenankan mengirimkan e-mail <em>spam</em> dengan merujuk ke bagian apapun dari GreenPlaza.</li>
<li>GreenPlaza berhak menyesuaikan dan atau menghapus informasi barang, dan menonaktifkan akun Pengguna.</li>
<li>GreenPlaza memiliki hak untuk memblokir penggunaan sistem terhadap Pengguna yang melanggar peraturan perundang-undangan yang berlaku di  Indonesia.</li>
<li>Pengguna akan mendapatkan beragam informasi promo terbaru dan penawaran eksklusif. Namun Pengguna dapat berhenti berlangganan (<em>unsubscribe</em>) jika tidak ingin menerima informasi tersebut.</li>
<li>Pengguna dilarang menggunakan logo GreenPlaza di foto profil</li>
<li>Pengguna dilarang menggunakan kata-kata kasar di fitur kirim pesan atau chat maupun kolom diskusi retur.</li>
<li>Pengguna dilarang menggunakan fitur kirim pesan atau chat sebagai iklan promosi barang dagangan di GreenPlaza. Pengguna juga dilarang menggunakan fitur kirim pesan atau chat sebagai iklan promosi barang dagangan di platform atau situs lain.</li>
<li>Pengguna dilarang menggunakan fitur kirim pesan atau chat sebagai sarana penelitian, kuesioner, atau <em>survey</em>.</li>
<li>Pengguna dilarang melakukan transfer atau menjual akun Pengguna ke Pengguna lain atau ke pihak lain tanpa persetujuan dari GreenPlaza.</li>
<li>Pengguna dilarang membuat akun GreenPlaza dengan tujuan menghindari batasan pembelian, penyalahgunaan voucher, atau konsekuensi kebijakan Aturan Penggunaan GreenPlaza lainnya.</li>
<li>Pengguna dilarang membuat salinan, modifikasi, turunan atau distribusi konten atau mempublikasikan tampilan yang berasal dari GreenPlaza yang dapat melanggar Hak Kekayaan Intelektual.</li>
<li>Pengguna dengan ini menyatakan bahwa Pengguna telah mengetahui seluruh peraturan perundang- undangan yang berlaku di wilayah Republik Indonesia dalam setiap transaksi di GreenPlaza, dan tidak akan melakukan tindakan apapun yang melanggar peraturan perundang-undangan Republik Indonesia.</li>
</ol>

<p> </p>

<h3>Jual Barang</h3>

<ol>
<li>Penjual bertanggung jawab secara penuh atas segala risiko yang timbul di kemudian hari terkait dengan informasi yang dibuatnya, termasuk, namun tidak terbatas pada hal-hal yang berkaitan dengan hak cipta, merek, desain industri, desain tata letak sirkuit, hak paten dan/atau izin lain yang telah ditetapkan atas suatu produk menurut hukum yang berlaku di Indonesia.</li>
<li>Penjual hanya diperbolehkan menjual barang-barang yang tidak tercantum di daftar <strong>“Barang Terlarang”</strong>.</li>
<li>Penjual wajib menempatkan barang dagangan sesuai dengan kategori dan subkategorinya.</li>
<li>Penjual wajib mengisi nama atau judul barang dengan jelas, singkat dan padat.</li>
<li>Penjual wajib mengisi harga yang sesuai dengan harga sebenarnya.</li>
<li>Penjual tidak diperkenankan mencantumkan alamat, nomor kontak, alamat e-mail, situs, forum, <em>username</em> media sosial, dan nomor rekening bank selain pada kolom yang disediakan.</li>
<li>penjual wajib memperbarui (<em>update</em>) ketersediaan dan status barang yang dijual.</li>
<li>Catatan penjual diperuntukkan bagi penjual yang ingin memberikan catatan tambahan yang tidak terkait dengan deskripsi barang kepada calon Pembeli. Catatan penjual tetap tunduk terhadap Aturan Penggunaan GreenPlaza.</li>
<li>Penjual wajib mengisi kolom Deskripsi Barang sesuai dengan Aturan Penggunaan di GreenPlaza.</li>
<li>Penjual dilarang membuat transaksi fiktif atau palsu demi kepentingan menaikkan <em>feedback</em>. GreenPlaza berhak mengambil tindakan seperti pemblokiran akun atau tindakan lainnya apabila ditemukan tindakan kecurangan.</li>
<li>Penjual wajib mengirimkan barang menggunakan jasa ekspedisi sesuai dengan yang dipilih oleh Pembeli pada saat melakukan transaksi di dalam sistem GreenPlaza.</li>
<li>Apabila penjual menggunakan jasa ekspedisi yang berbeda dengan jasa dan/atau jenis jasa ekspedisi yang dipilih oleh Pembeli pada saat melakukan transaksi di dalam sistem GreenPlaza maka penjual bertanggung jawab atas segala hal selama proses pengiriman yang disebabkan oleh penggunaan jasa dan/atau jenis jasa ekspedisi yang berbeda tersebut.</li>
<li>Pembeli berhak atas kelebihan dana dari biaya kirim yang diakibatkan perbedaan penggunaan jasa dan/atau jenis jasa ekspedisi oleh penjual dari pilihan Pembeli pada saat melakukan transaksi di dalam sistem GreenPlaza.</li>
<li>Penjual wajib memenuhi ketentuan yang sudah ditetapkan oleh pihak jasa ekspedisi berkaitan dengan <em>packing</em> barang yang aman serta menggunakan asuransi dan/atau <em>packing</em> kayu pada barang-barang tertentu sehingga apabila barang rusak atau hilang penjual dapat mengajukan klaim ke pihak jasa ekspedisi.</li>
</ol>

<p> </p>

<h3>Transaksi</h3>

<ol>
<li>Demi keamanan dan kenyamanan para Pengguna, setiap transaksi jual-beli di GreenPlaza diwajibkan untuk menggunakan GreenPlaza Payment System.</li>
<li>Pembeli wajib transfer sesuai dengan nominal total belanja dari transaksi dalam waktu 1x10 jam (dengan asumsi Pembeli telah mempelajari informasi barang yang telah dipesannya). Jika dalam waktu 1x24 jam barang dipesan tetapi Pembeli tidak mentransfer dana maka transaksi akan dibatalkan secara otomatis.</li>
<li>Setiap transaksi di GreenPlaza yang menggunakan metode transfer akan dikenakan biaya operasional dalam bentuk kode unik pembayaran yang ditanggung oleh Pembeli.</li>
<li>Pembeli tidak dapat membatalkan transaksi setelah melunasi pembayaran.</li>
<li>Jika penjual tidak menentukan waktu kirim barang pada setiap produknya, maka penjual wajib mengirimkan barang dalam waktu 3x24 jam di hari kerja (untuk biaya pengiriman reguler) atau 2x24 jam (untuk biaya pengiriman kilat) setelah status transaksi “<strong>Payed</strong>”.</li>
<li>penjual wajib mengirimkan barang dan mendaftarkan nomor resi pengiriman yang benar dan asli setelah status transaksi “<strong>Payed</strong>”. Satu nomor resi hanya berlaku untuk satu nomor transaksi di GreenPlaza.</li>
<li>Sistem GreenPlaza secara otomatis mengecek status pengiriman barang melalui nomor resi yang diberikan penjual. Apabila nomor resi terdeteksi tidak valid dan penjual tidak melakukan ubah resi valid dalam 1x24 jam maka seluruh dana akan dikembalikan ke Pembeli. Jika penjual memasukkan nomor resi tidak valid lebih dari satu kali maka GreenPlaza akan mengembalikan seluruh dana transaksi kepada Pembeli dan Penjual mendapatkan <em>feedback</em> negatif.</li>
<li>Jika Pembeli tidak memberikan konfirmasi penerimaan barang dalam waktu 3x24 jam sejak status resi pengiriman dinyatakan telah diterima/delivered oleh sistem <em>tracking</em> jasa pengiriman, GreenPlaza akan mentransfer dana langsung ke cashwallet penjual tanpa memberikan konfirmasi ke Pembeli.</li>
<li>Sistem secara otomatis memberikan <em>feedback</em> (rekomendasi) positif dan mentransfer dana pembayaran ke cashwallet penjual jika status resi menunjukkan ‘<strong>Barang diterima</strong>’ dan Pembeli telah melewati batas waktu untuk konfirmasi.</li>
<li>GreenPlaza akan mengembalikan dana transaksi ke Pembeli jika <strong>dalam waktu 3x24</strong> jam penjual tidak merespon pesan permintaan retur dari Pembeli. Selanjutnya, Pembeli wajib mengirimkan barang tersebut ke kantor GreenPlaza.</li>
<li>GreenPlaza tidak bertanggung jawab terhadap barang retur di kantor GreenPlaza apabila penjual tidak melakukan pengaduan kepemilikan barang dalam waktu 30 hari sejak barang diterima di kantor GreenPlaza.</li>
<li>Pembeli wajib mengirimkan barang ke penjual dan menginformasikan nomor resi ke GreenPlaza jika ada kesepakatan retur dengan penjual.</li>
<li>GreenPlaza hanya memantau retur sampai barang diterima kembali oleh penjual.</li>
<li>GreenPlaza berhak melakukan <em>refund</em> dana ke Pembeli jika barang retur telah sampai di kantor GreenPlaza dan berdasarkan pengecekan sesuai dengan yang dikeluhkan Pembeli.</li>
<li>GreenPlaza atas kebijakannya sendiri dapat melakukan penahanan atau pembekuan cashwallet untuk melakukan perlindungan terhadap segala risiko dan kerugian yang timbul, jika GreenPlaza menyimpulkan bahwa tindakan Pengguna, baik penjual maupun Pembeli terindikasi melakukan kecurangan-kecurangan atau penyalahgunaan dalam bertransaksi dan/atau pelanggaran terhadap Aturan Penggunaan GreenPlaza dan jika akun Pengguna diduga atau terindikasi telah diakses oleh pihak lain.</li>
</ol>

<p> </p>

<h3>Penggunaan Voucher</h3>

<ol>
<li>Voucher hanya berlaku untuk transaksi dengan pengiriman yang menggunakan jasa ekspedisi yang tersedia di GreenPlaza.</li>
<li>GreenPlaza berhak melakukan tindakan-tindakan yang diperlukan tanpa pemberitahuan sebelumnya. Tindakan tersebut seperti pembatalan transaksi, pembatalan voucher, pemblokiran akun Pengguna, atau tindakan lainnya apabila ditemukan kecurangan dari Pengguna.</li>
<li>GreenPlaza berhak melakukan pembatalan transaksi atau membatalkan penggunaan voucher sewaktu-waktu tanpa pemberitahuan terlebih dahulu kepada Pengguna.</li>
<li>GreenPlaza berhak mengubah syarat dan ketentuan sewaktu-waktu tanpa pemberitahuan terlebih dahulu kepada Pengguna.</li>
</ol>

<p> </p>

<h3>Barang Terlarang</h3>

<p>GreenPlaza telah dan akan terus melakukan hal-hal sebagaimana dipersyaratkan oleh peraturan perundang-undangan untuk mencegah terjadinya perdagangan barang-barang yang melanggar ketentuan hukum yang berlaku dan/atau hak pribadi pihak ketiga. Berkenaan dengan hal tersebut, berikut adalah barang-barang yang dilarang untuk diperjualbelikan melalui GreenPlaza:</p>

<ol>
<li>Segala bentuk tulisan yang dapat berpengaruh negatif terhadap GreenPlaza</li>
<li>Narkotika, obat-obat tidak terdaftar di Dinkes dan/atau BPOM, dan obat yang harus disertai dengan resep dari Dokter</li>
<li>Senjata api, kelengkapan senjata api, replika senjata api, airsoft gun, air gun, dan peluru atau sejenis peluru, senjata tajam, serta jenis senjata lainnya</li>
<li>Dokumen pemerintahan dan perjalanan</li>
<li>Organ manusia</li>
<li>Mailing list dan informasi pribadi</li>
<li>Barang-barang yang melecehkan pihak/ras tertentu atau dapat menyinggung perasaan orang lain</li>
<li>Barang yang berhubungan dengan kepolisian</li>
<li>Barang yang belum tersedia (<em>pre order</em>) terkecuali penjual sanggup mengirim barang dalam waktu yang telah ditentukan (waktu kirim barang) atau 3x24 jam kerja setelah status transaksi <em>“<strong>Dibayar</strong>”</em></li>
<li>Barang curian</li>
<li>Barang mistis</li>
<li>Pembuka kunci dan segala aksesori penunjang tindakan perampokan/pencurian</li>
<li>Barang yang dapat dan atau mudah meledak, menyala atau terbakar sendiri</li>
<li>Pornografi, <em>sex toys</em>, alat untuk memperbesar organ vital pria, maupun barang asusila lainnya</li>
<li>Barang cetakan/rekaman yang isinya dapat mengganggu keamanan & ketertiban serta stabilitas nasional</li>
<li>CD, DVD, dan <em>Software</em> bajakan</li>
<li>Segala jenis binatang atau hewan peliharaan</li>
<li>Jasa, donasi, sewa menyewa, promo <em>event</em> dan sejenisnya terkecuali ada kerja sama resmi dengan pihak GreenPlaza</li>
<li>Merek dagang</li>
<li>Otomotif (Mobil dan Motor) terkecuali ada kerja sama resmi dengan pihak GreenPlaza</li>
<li>Velg Mobil</li>
<li>Properti (Rumah, Tanah, dan lain-lain)</li>
<li>Produk non-fisik yang tidak dapat dikirimkan melalui jasa kurir terdaftar/tidak terdaftar, termasuk namun tidak terbatas pada akun GreenPlaza, <em>e-Book</em>, akun game, pulsa elektrik maupun pulsa fisik/voucher, voucher kuota internet, voucher game, voucher aplikasi, steam wallet, dan lainnya; terkecuali ada kerja sama resmi dengan pihak GreenPlaza</li>
<li>Produk yang bukan produk asli dengan merek, atau berkaitan dengan merek terdaftar</li>
<li>Gadget (ponsel, tablet, phablet, <em>smartwatch</em>, dan sejenisnya) replika atau berasal dari pasar gelap (<em>black market</em>)</li>
<li>Barang-barang lain yang dilarang untuk diperjualbelikan secara bebas berdasarkan hukum yang berlaku di Indonesia</li>
</ol>

<p> </p>

<h3>Sanksi</h3>

<p>Segala tindakan yang melanggar peraturan di GreenPlaza akan dikenakan sanksi berupa termasuk namun tidak terbatas pada:</p>

<ol>
<li>penjual mendapatkan 1 <em>feedback</em> negatif apabila tidak mengirimkan barang dalam batas waktu pengiriman sejak pembayaran (Jika penjual tidak menentukan waktu kirim barang pada setiap produknya, maka 2x24 jam kerja untuk biaya pengiriman reguler atau 2x24 jam untuk biaya pengiriman kilat).</li>
<li>penjual mendapatkan 1 <em>feedback</em> negatif jika sudah 5 kali menolak pesanan.</li>
<li>penjual mendapatkan 3 <em>feedback</em> negatif jika sudah memroses pesanan namun tidak kirim barang dalam batas waktu pengiriman sejak pembayaran (Jika penjual tidak menentukan waktu kirim barang pada setiap produknya, maka 2x24 jam kerja untuk biaya pengiriman reguler atau 2x24 jam untuk biaya pengiriman kilat).</li>
<li>Penonaktifkan fitur pesan.</li>
<li>Pelaporan ke pihak yang berwenang (Kepolisian, dll).</li>
</ol>

<p> </p>

<h3>Pembatasan Tanggung Jawab</h3>

<ol>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul dari dan dalam kaitannya dengan informasi yang dituliskan oleh Pengguna GreenPlaza.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala pelanggaran hak cipta, merek, desain industri, desain tata letak sirkuit, hak paten atau hak-hak pribadi lain yang melekat atas suatu barang, berkenaan dengan segala informasi yang dibuat oleh penjual. </li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul berkenaan dengan penggunaan barang yang dibeli melalui GreenPlaza, dalam hal terjadi pelanggaran peraturan perundang-undangan.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul berkenaan dengan diaksesnya akun Pengguna oleh pihak lain.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat kelalaian pengguna dalam menjaga kerahasiaan Kode Verifikasi.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat transaksi di luar GreenPlaza Payment System.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat kesalahan atau perbedaan nominal yang seharusnya ditransfer ke rekening atas nama <strong>PT. Jagadsanti Dhanam Vujhahiroca</strong></li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul apabila transaksi telah selesai secara sistem (dana telah masuk ke cashwallet penjual ataupun Pembeli).</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat kehilangan barang ketika proses transaksi berjalan dan/atau selesai.</li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat kesalahan Pengguna ataupun pihak lain dalam transfer dana ke rekening <strong>PT. Jagadsanti Dhanam Vujhahiroca</strong></li>
<li>GreenPlaza tidak bertanggung jawab atas segala risiko dan kerugian yang timbul akibat penyalahgunaan nomor kontak dan/atau alamat e-mail milik Pengguna maupun pihak lainnya.</li>
<li>Dalam keadaan apapun, Pengguna akan membayar kerugian GreenPlaza dan/atau menghindarkan GreenPlaza (termasuk petugas, direktur, karyawan, agen, dan lainnya) dari setiap biaya kerugian apapun, kehilangan, pengeluaran atau kerusakan yang berasal dari tuntutan atau klaim pihak ketiga yang timbul dari pelanggaran Pengguna terhadap Aturan Penggunaan GreenPlaza, dan/atau pelanggaran terhadap hak dari pihak ketiga.</li>
</ol>

<p> </p>

<h3>Hukum yang Berlaku dan Penyelesaian Sengketa</h3>

<ul>
<li>Aturan Penggunaan ini dilaksanakan dan tunduk pada Peraturan Perundang-undangan Republik Indonesia.</li>
<li>Apabila terjadi perselisihan, sebelum beralih ke alternatif lain, Pengguna wajib terlebih dahulu menghubungi GreenPlaza secara langsung agar dapat melakukan perundingan atau musyawarah untuk mencapai resolusi bagi kedua belah pihak.</li>
<li>Sebelum menghubungi GreenPlaza secara langsung untuk melakukan perundingan penyelesaian masalah atau sengketa, Pengguna setuju untuk tidak mengumumkan, membuat tulisan-tulisan di media online maupun cetak terkait permasalahan yang dapat menyudutkan GreenPlaza (termasuk petugas, direktur, karyawan dan agen).</li>
<li>Apabila dalam waktu 1 (satu) bulan setelah dimulainya perundingan atau musyawarah tidak mencapai resolusi, maka para pihak akan menyelesaikan perselisihan tersebut melalui Pengadilan Negeri Jakarta Selatan.</li>
<li><strong>Selama perselisihan dalam proses penyelesaian, Pengguna wajib untuk tetap melaksanakan kewajiban-kewajiban lainnya menurut Aturan Penggunaan GreenPlaza.</strong></li>
</ul>',
                'page_status' => 1,
                'page_slug' => 'term-and-condition',
                'created_at' => '2019-02-06 17:32:42',
                'updated_at' => '2019-02-06 17:42:36',
            ),
            11 => 
            array (
                'id' => 12,
                'page_judul' => 'Tentang GreenPlaza',
                'page_role_id' => 0,
                'page_kategori' => 'greenplaza',
                'page_header_image' => NULL,
                'page_text' => '<p><strong>GreenPlaza merupakan salah satu </strong><em>online marketplace</em><strong>&nbsp; di Indonesia yang menyediakan sarana jual&ndash;beli dari konsumen ke konsumen. Semua orang dapat membuka toko online di GreenPlaza dan melayani pembeli dari seluruh Indonesia untuk transaksi satuan maupun banyak.</strong></p>',
                'page_status' => 1,
                'page_slug' => 'tentang-greenplaza',
                'created_at' => '2019-02-06 17:37:47',
                'updated_at' => '2019-02-06 17:37:47',
            ),
            12 => 
            array (
                'id' => 13,
                'page_judul' => 'Refund Policy',
                'page_role_id' => 0,
                'page_kategori' => 'aboutus',
                'page_header_image' => NULL,
                'page_text' => '<h2><center>Kebijakan Privasi</center></h2>

<p>1. Kami berkomitmen untuk mematuhi peraturan perlindungan data yang berlaku terhadap kami</p>

<p>2. <strong>Kebijakan Privasi ini dibuat agar Anda mengetahui cara penggunaan, pengolahan, dan penanganan data yang kami kumpulkan dan terima selama penyediaan Jasa atau akses bagi konsumen kami</strong>. Kami hanya akan mengumpulkan, menggunakan, dan mengungkapkan data pribadi Anda sesuai dengan Kebijakan Privasi ini.</p>

<p>3. Dengan klik Register berarti anda telah setuju dengan ketentuan dan privasi kami</p>

<p>4. Kami dapat mengumpulkan data pribadi berikut ini dari Anda seperti data identitas, kontak, rekening, transaksi, teknis, profil, penggunaan.</p>

<p>5. Anda harus mengirimkan data pribadi yang akurat dan tidak menyesatkan dan Anda harus memastikan data pribadi tersebut adalah data terkini dan memberitahukan kami tentang pengubahan pada data tersebut.</p>

<p>6. Anda dapat mengakses dan memperbarui informasi pribadi Anda yang dikirimkan kepada kami</p>

<p>7. Mengirimkan produk yang Anda beli melalui GreenPlaza baik dijual oleh kami atau penjual pihak penjual. Kami dapat menyampaikan informasi pribadi Anda kepada pihak penjual untuk melakukan pengiriman produk kepada Anda (misalnya ke kurir atau pemasok kami), baik produk tersebut dijual melalui<em> GreenPlaza</em> oleh kami atau penjual</p>

<p>8. Jika Anda merasa bahwa privasi Anda telah dilanggar oleh GreenPlaza, mohon hubungi Staf bagian Perlindungan Data  kami melalui kontak telegram yang tersedia</p>

<p>9. Kata sandi Anda adalah kunci untuk akun Anda. Harap gunakan nomor unik, huruf dan karakter khusus, dan jangan bagikan kata sandi GreenPlaza Anda kepada siapa pun. Jika Anda membagikan kata sandi Anda dengan orang lain, Anda akan bertanggung jawab atas semua tindakan yang diambil atas nama akun Anda dan konsekuensinya.</p>

<p>10. GreenPlaza tidak menjual produk untuk dibeli oleh anak-anak dibawah usia 18 tahun, dan juga tidak bermaksud untuk menyediakan Layanan apa pun atau penggunaan<em> GreenPlaza</em> untuk anak-anak di bawah usia 18 tahun. Kami tidak dengan sengaja mengumpulkan data pribadi yang berkaitan dengan anak-anak di bawah usia 18 tahun</p>',
                'page_status' => 1,
                'page_slug' => 'refund-policy',
                'created_at' => '2019-02-06 17:39:41',
                'updated_at' => '2019-02-06 17:42:25',
            ),
        ));
        
        
    }
}