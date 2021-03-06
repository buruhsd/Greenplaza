<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Giplaza | MarketPlace Community</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/gi_plaza.png')}}">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v3.3.7 css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/metisMenu.min.css') }}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <!-- slicknav.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style-responsive.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- added by fahmi --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style-new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/popover-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">

    <!-- modernizr css -->
    <script src="{{ asset('frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    {{-- pre loader --}}
    <style>
    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript, 
    if it's not present, don't show loader */
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{asset('loader/loader-128x/gi120.png')}}") center no-repeat #fff;
    }

    .borderless td, .borderless th {
    border-top: #fff;
}

.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #fff}

    .cetagory-wrap span {
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 500;
    display: block;
    text-align: center;
    padding: 15px 0px;
    border-top: none;
    border-bottom: none;
    color: #121212;
}

.non-margin {
    margin-bottom: 0px;
}


    .featured-wrap {
    padding: 10px;
    background: #fff;
    margin-bottom: 0px;
    margin-top: 0px;
    }

    .featured2-wrap {
    padding: 10px;
    background: #fff;
    margin-bottom: 40px;
    margin-top: -175px;
    }

    .featured-wrap1 {
        padding: 10px;
        background: #fff;
        margin-bottom: 30px;
    }
    a#scrollUp {
        position: absolute;
        right: 20px;
        bottom: 100px;
        height: 40px;
        width: 40px;
        background: #4caf50;
        text-align: center;
        line-height: 40px;
        color: #fff;
        border: 2px solid #4caf50;
    }

    a#scrollUp:hover {
        background: #f5f5f5;
    }

    .product-content {
    padding: 20px 10px 200px;
    border: 1px solid #e1e1e1;
    border-top: none;
    height: 175px;
    }

    .product-content2 {
        padding: 20px 10px 10px;
        border: 1px solid #e1e1e1;
        border-top: none;
        height: 200px;
    }

    .product-content2 h3 {
        font-size: 15px;
    }

    .product-content2 h4 {
        font-size: 12px;
    }
    .product-content2 p del {
        font-size: 13px;
        font-weight: 400;
        margin-left: 5px;
    }

    .tombol-product {
        width: 90%;
        bottom: 0;
        padding-bottom: 10px;
        position: absolute;
    }

    .logo-header-initila-1{
    margin-right: 4rem
    }
    .logo-responsive-initila-1{
        padding: 0.8rem 0;
        background: #f5f5f5;
    }
    .space-header-and-body{
        padding-top: 62px;
        margin-bottom: 180px;
    }

    .tombol-product2 {
        width: 90%;
        bottom: 0;
        padding-bottom: 25px;
        position: absolute;
    }

    .style-cost-item-front {

      margin: 0;
      color: #3dcfe4;
      line-height: 30px;
      font-size: 15px;
      font-weight: 700;

    }
    .style-cost-discount-item-front {
      color: #999;
      line-height: 1.4;
      font-size: 13px;
      font-weight: 500;

    }

    .add-btn {
      padding-bottom: 40px;
      width: 70%;

    }

    .lazy-background{
    }

    .one{
      height: 310px;
      background-image: url("gi_image/iklan/poster1.png");
    }

    .one.visible{
      background-image: url("gi_image/iklan/poster1.png");
    }

    .two{
      height: 310px;
      background-image: url("gi_image/iklan/poster2.png");
    }

    .two.visible{
      background-image: url("gi_image/iklan/poster2.png");
    }

    .three{
      height: 310px;
      background-image: url("gi_image/iklan/poster3.png");
    }

    .three.visible{
      background-image: url("gi_image/iklan/poster3.png");
    }

    .four{
        width: 30px;
      background-image: url("frontend/images/icon/hotel.png");
    }

    .four.visible{
      background-image: url("frontend/images/icon/hotel.png");
    }

    .five{
        width: 30px;
      background-image: url("frontend/images/icon/game.png");
    }

    .five.visible{
      background-image: url("frontend/images/icon/game.png");
    }

    .six{
        width: 30px;
      background-image: url("frontend/images/icon/kartukredit.png");
    }

    .six.visible{
      background-image: url("frontend/images/icon/kartukredit.png");
    }

    .seven{
        width: 30px;
      background-image: url("frontend/images/icon/voucheronline.png");
    }

    .seven.visible{
      background-image: url("frontend/images/icon/voucheronline.png");
    }

    .eight{
        width: 30px;
      background-image: url("frontend/images/icon/pesawat.png");
    }

    .eight.visible{
      background-image: url("frontend/images/icon/pesawat.png");
    }

    .nine{
        width: 30px;
      background-image: url("frontend/images/icon/pay.png");
    }

    .nine.visible{
      background-image: url("frontend/images/icon/pay.png");
    }

    .ten{
        width: 30px;
      background-image: url("frontend/images/icon/pdam.png");
    }

    .ten.visible{
      background-image: url("frontend/images/icon/pdam.png");
    }

    .eleven{
        width: 30px;
      background-image: url("frontend/images/icon/voucherfisik.png");
    }

    .eleven.visible{
      background-image: url("frontend/images/icon/voucherfisik.png");
    }

    .twelve{
        width: 30px;
      background-image: url("frontend/images/icon/plnprabayar.png");
    }

    .twelve.visible{
      background-image: url("frontend/images/icon/plnprabayar.png");
    }

    .thirteen{
        width: 30px;
      background-image: url("frontend/images/icon/tv.png");
    }

    .thirteen.visible{
      background-image: url("frontend/images/icon/tv.png");
    }

    .fourteen{
        width: 30px;
      background-image: url("frontend/images/icon/ticket.png");
    }

    .fourteen.visible{
      background-image: url("frontend/images/icon/ticket.png");
    }

    .fiveteen{
        width: 30px;
      background-image: url("frontend/images/icon/topupsaldo.png");
    }

    .fiveteen.visible{
      background-image: url("frontend/images/icon/topupsaldo.png");
    }

    @media only screen and (max-width: 670px) {
        .add-btn {
      padding-bottom: 40px;
      width: 85%;

        }
    }
    </style>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    {{-- end pre loader --}}
</head>