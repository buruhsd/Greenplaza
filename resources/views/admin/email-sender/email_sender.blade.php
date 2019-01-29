@extends('admin.index', ['active' => 'emailsender'])
@section('title', 'Email Sender')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Dashboard</h3>
</div>
@include('layouts._flash')
<div class="col-md-12">
    <div class="panel-body">
        <a href="{{route('admin.list_email')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">List Email</button></a>
        <center><form class="form-horizontal" method="POST" action= "{{route('admin.send_email')}}" enctype = "multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    Pengiriman 'Single Email' perlu mengisikan email yang di tuju di kolom 'sending to' untuk pengiriman emailnya !! Tidak berlaku untuk pilihan pengiriman email yang lain.
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <select name="value" type="text" class="form-control">
                          <option value="">--< Sender Option >--</option>
                          <option value="2">All Member</option>
                          <option value="3">All Seller</option>
                          <option value="4">All Member & Seller</option>
                          <option value="1">Single Email</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="email_to" placeholder="sending to" class="form-control">
                    </div>
                </div>
            </div>
            <textarea class="form-control" name="email_subject" placeholder="Email Subject" rows="4" style="margin-bottom: 2%"></textarea>
            <textarea class="form-control" id="article-ckeditor" name="email_text" placeholder="Email Text" rows="6"></textarea>
            <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 2%">Kirim Email</button>
        </form></center>
    </div>
</div>

<script>
        CKEDITOR.replace( 'article-ckeditor', {
            height: 400,
            
        } );

        function myFunction(x) {
            var copyText = document.getElementById(x);
            copyText.select();
            document.execCommand("Copy");
        } 
</script>            
                
@endsection
        