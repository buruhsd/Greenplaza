@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Dashboard</h3>
</div>
@include('layouts._flash')
<div class="col-md-12">
    <div class="panel-body">
        <a href="{{route('admin.list_email')}}"><button type="" class="btn btn-default pull-right">List Email</button></a>
        <center><form class="form-horizontal" method="POST" action= "{{route('admin.send_email')}}" enctype = "multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group" style="width: 40%">
                <input type="text" name="email_to" class="form-control" id="" placeholder="Input Email Sending">
            </div>
            <textarea class="form-control" id="article-ckeditor" name="email_subject" placeholder="Email Subject" rows="1" style="margin-bottom: 2%"></textarea>
            <textarea class="form-control" id="article-ckeditor" name="email_text" placeholder="Email Text" rows="6"></textarea>
            <div class="col-md-6" style="margin-top: 3%">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            <div class="col-md-6" style="margin-top: 3%">
                <button type="submit" class="btn btn-primary">Send for All</button>
            </div>
        </form></center>
    </div>
</div>
    

<script src="{{asset('backend/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
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
        