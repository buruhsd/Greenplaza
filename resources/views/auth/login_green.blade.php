<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GreenPlaza</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/gi_plaza.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/style.css') }}">

</head>
<body>



<form method="POST" action="{{ route('login') }}">
    @csrf
    @include('layouts._flash')
    <div class="col-md-4 col-md-offset-4">
        <br/>
        <div class="text-center">
            <a href="{{url('/')}}"><br/>
                 <img class="dark-logo" src="{{ asset('frontend/images/logo-fix-2.png') }}" alt="" width="120px" height="40px">
            </a>
        </div>
        <br/>

                @if ($errors->has('email'))
                    <div class="alert alert-info text-center">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-info text-center">
                        {{ $errors->first('password') }}
                    </div>
                @endif

        <div class="form-group row">
            <label class="col-md-12" for="email">username GI</label>
            <div class="col-md-12">
                <input class="form-control" id="email" type="text" name="email" required>
                <!-- @if ($errors->has('email'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="password">password GI</label>
            <div class="col-md-12">
                <input class="form-control" id="password" type="password" name="password" required>
                <!-- @if ($errors->has('password'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>
        <div style="font-size: 12px">belum punya akun? <a href="https://gicommunity.org/register"> daftar </a></div><br>
        <button type="submit" class="btn btn-success btn-block">Masuk</button>
        <br/>
    </div>
</form>

</body>
    <script src="{{ asset('js/js.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('flash_message'))
    <?php $status = (Session::get('flash_status') == 200)?'success':'error';?>
    <?php $status_type = (Session::get('flash_status') == 200)?'Success':'Failed';?>
    <script type="text/javascript">
        swal({   
            type: "{{ $status }}",
            title: "{{ $status_type }}",   
            html: "{!! Session::get('flash_message') !!}",   
            showConfirmButton: false ,
            showCloseButton: true,
            footer: ''
        });
    </script>
    @endif
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5cbe8a7ad6e05b735b43c9e3/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</html>
