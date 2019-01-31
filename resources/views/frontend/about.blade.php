<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('faq/css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('faq/css/style.css') }}"> <!-- Resource style -->
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
  <h1>Tentang Greenplaza</h1>
  <h4><p ><a href="{{url('/')}}" style="color:#fff">Home</a> / Tentang Greenplaza</p></h4>
</div>
<section class="cd-faq">
    <ul class="cd-faq-categories">
        
        <p style="font-weight: 200; font-size: 18px;">Belum Menemukan Jawaban yang Kamu Cari?</p><p style="color: #4caf50; font-size: 18px;"> Hubungi Greenplaza</p> <br>
        <p style="font-weight: 200; font-size: 18px;">Dapatkan Tips Belanja dan Berjualan Aman di Greenplaza</p>
    </ul> <!-- cd-faq-categories -->

    <div class="cd-faq-items">
        <ul id="basics" class="cd-faq-group">
            <li class="cd-faq-title"><h2></h2></li>
            @foreach($page as $item)
            <li>
                <a class="cd-faq-trigger" href="#0">{{$item->page_judul}}</a>
                <div class="cd-faq-content">
                    <p>{!!$item->page_text!!}</p>
                </div> <!-- cd-faq-content -->
            </li>
        @endforeach<!-- cd-faq-group -->
        </ul> 
    </div> <!-- cd-faq-items -->
    <a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="{{ asset('faq/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('faq/js/jquery.mobile.custom.min.js') }}"></script>
<script src="{{ asset('faq/js/main.js') }}"></script> <!-- Resource jQuery -->
</body>
</html>
