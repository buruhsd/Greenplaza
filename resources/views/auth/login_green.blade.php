<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GreenPlaza</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" type="text/css"  href="{{ asset('frontendlama/css/reg_style.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/style.css') }}">

</head>
<body>



<form method="POST" action="{{ route('login') }}">
    @csrf
    @include('layouts._flash')
    <div class="container col-md-8 col-md-offset-2">
        <br/>
        <div class="text-center">
            <a href="{{url('/')}}">
                <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="300px" height="100px">
            </a>
        </div>
        <hr/>
        <p>Belum Punya Akun ? <a href="{{ route('register') }}"> Daftar disini </a>.</p>

                @if ($errors->has('email'))
                    <div class="alert alert-info">
                        <strong></strong> {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-info">
                        <strong></strong> {{ $errors->first('password') }}
                    </div>
                @endif

        <div class="form-group row">
            <label class="col-md-12" for="email"><b>Email / Username</b></label>
            <div class="col-md-12">
                <input class="form-control" id="email" type="text" placeholder="Email / Username" name="email" required>
                <!-- @if ($errors->has('email'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="password"><b>Password</b></label>
            <div class="col-md-12">
                <input class="form-control" id="password" type="password" placeholder="Password" name="password" required>
                <!-- @if ($errors->has('password'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>

{{--         <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}
        <hr>

        <button type="submit" class="btn btn-success btn-block">Masuk</button>
        <br/>
        <p><a href="{{route('password.request')}}">Lupa Password</a>.</p>
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
</html>
