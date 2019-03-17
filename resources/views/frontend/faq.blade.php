<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('faq/css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('faq/css/style.css') }}"> <!-- Resource style -->
    <link rel="stylesheet" href="{{asset('admin/css/jquery.popdown.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}"> -->
    <script src="{{ asset('faq/js/modernizr.js') }}"></script> <!-- Modernizr -->
    <style>
    /* Style the body */
    body {
      font-family: Arial;
      margin: 0;
    }

    /* Header/Logo Title */
    .header {
      padding: 60px;
      text-align: center;
      background: #4caf50;
      color: white;
      font-size: 30px;
    }
    </style>
    <title>GreenPlaza</title>
</head>
<body>
<div class="header">
  <h1>Frequently Asked Questions </h1>
  <h4><p ><a href="{{url('/')}}" style="color:#fff">Home</a> / FAQ</p></h4>
</div>
<section class="cd-faq">
    <ul class="cd-faq-categories">
        
        <p style="font-weight: 200; font-size: 18px;">Belum Menemukan Jawaban yang Kamu Cari?</p><p style="color: #4caf50; font-size: 18px; cursor: pointer;" onclick="newDoc()"> Hubungi Greenplaza </p> <br>
        <p style="font-weight: 200; font-size: 18px;">Dapatkan Tips Belanja dan Berjualan Aman di Greenplaza</p>
    </ul> <!-- cd-faq-categories -->

    <div class="cd-faq-items">
        <ul id="basics" class="cd-faq-group">
            <li class="cd-faq-title"><h2></h2></li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q : Barang ready gak 1 lusin ? 1 DOZ ? 100 pcs ? Dll...</a>
                <div class="cd-faq-content">
                    <h5>A : Semua barang yang ada di Etalase, dan bisa di klik "Add to Chart" kemudian "Memproses ke Checkout" = READY.</h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q : Kok pesananku ditolak karena barang habis? Katanya barang yang ada di Etalase= READY</a>
                <div class="cd-faq-content">
                    <h5>A : Saat Buyer melakukan Order, barangnya masih ada. Tapi saat diproses verifikasi dari GreenPlaza, barangnya sudah habis. Karena banyak yang Order otomatis perputaran barang juga cepat.</h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q : kak no.resinya mana ? Saya sudah transfer dari kemarin.</a>
                <div class="cd-faq-content">
                    <h5>A:  Yang perlu diketahui :
                      <h6>a. . Tanpa adanya resi, uang yang dibayarkan oleh Pembeli tidak akan masuk ke rekening Pembeli.<br/>
                        b. Uang yang sudah ditransfer, masuknya ke rekening GreenPlaza. BELUM masuk ke rekening Penjual. Uang tsb. akan masuk ke rekening Penjual, setelah Pembeli tekan "KONFIRMASI PENERIMAAN BARANG". <br/>
                        c. Proses verifkasi GreenPlaza belum tentu sama dengan saat Pembeli melakukan transfer</h6>
                    </h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q : kak.. barang pecah / hancur, saya minta ganti.</a>
                <div class="cd-faq-content">
                    <h5>A :  Kami mengirimkan via Expedisi  - Kantor Perwakilan- Kalau memang pecahnya dari Penjual, barang kiriman tsb. akan ditolak oleh pihak Ekspedisi, dikembalikan dan dipacking ulang.<br/> <br/>
                    <h6>Sekedar info, step proses order ke Penjual :<br/>
                    Order baru --> Admin (Penjual) --> Gudang (Penjual) -->  Ekspedisi --> Verifikasi Pembeli --> Respon admin ( Penjual) Checking + Packing --> Final Check by Ekspedition (RESI) <br/>
                    Jadi kalau resi sudah diinput berarti packing sudah memenuhi syarat untuk dikirim. Barang dalam keadaan baik sebelum dikirim dan rusak akibat ekspedisi ketika perjalanan. Tidak bisa klaim kecuali menggunakan asuransi JNE</h6>
                    </h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q :  kak, buka JNE OKE donk.. kalo REG kemahalan di ongkirnya</a>
                <div class="cd-faq-content">
                    <h5>A :  JNE-OKE memang lebih murah, tetapi kiriman barang jadi sampai lebih lama. Otomatis Pembeli melakukan <strong>“Konfirmasi Penerimaan Barang”</strong> juga lebih lama. Hal tersebut dapat mempengaruhi management cash-flow dari Penjual</h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q :  kak, tolong dibuat 1kg aja bisa gak ya ? soalnya total berat 1,1kg</a>
                <div class="cd-faq-content">
                    <h5>A : Tidak bisa. Kami packing dengan bubble-pack (wrap) dan atau dengan dus. Tergantung dari berat dan banyaknya pesanan. Kemungkinan untuk beratnya bisa bertambah iya, tapi untuk berkurang tidak bisa.</h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0"> Q : input resi yang bener donk</a>
                <div class="cd-faq-content">
                    <h5>A : Status pengiriman tidak ditemukan . Hal ini dapat terjadi akibat :<br/>
                    <h6>a. Agen pengiriman belum memperbaharui status.<br/>
                    b.  Situs agen pengiriman sedang berkendala<br/>
                    c.  Kesalahan input tanggal pengiriman</h6>
                    </h5>
                </div> <!-- cd-faq-content -->
            </li>
            <li>
                <a class="cd-faq-trigger" href="#0">Q : kak, saya salah order nih.. udah trf nih, bisa dikembaliin gk uangnya atau dicancel?</a>
                <div class="cd-faq-content">
                    <h5>A : Pengembalian dana tidak berlaku untuk kesalahan order /kelalaian dari pihak pembeli. Oder yang belum dibayar bisa dibatalkan oleh Pembeli. Order yang telah dibayar tidak bisa pengembalian dana. Karena setelah kamu transfer, order dianggap fix dan hanya dihandle sesuai data di invoice. Kami tidak melayani pengubahan/penambahan/pengurangan variasi , barang, alamat.</h5>
                </div> <!-- cd-faq-content -->
            </li>
        </ul> 
    </div> <!-- cd-faq-items -->
    <a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script>
function newDoc() {
    window.location.assign("{{url('/cs')}}")
}
</script>
<script src="{{ asset('faq/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('faq/js/jquery.mobile.custom.min.js') }}"></script>
<script src="{{ asset('faq/js/main.js') }}"></script> <!-- Resource jQuery -->
</body>
</html>
