@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Dashboard</h3>
</div>
<div class="col-md-12">
    <div class="panel-body">
        <center><form>
            <div class="form-group" style="width: 50%">
                <input type="text" class="form-control" id="" placeholder="Input Email Sending">
            </div>
            <textarea class="form-control" id="article-ckeditor" name="description" placeholder="Post" rows="6"></textarea>
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
        