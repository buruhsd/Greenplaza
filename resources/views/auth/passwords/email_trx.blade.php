<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width, initial-scale=1" name="viewport" />
{{-- <link rel="stylesheet" type="text/css"  href="{{ asset('frontend/css/reg_style.css') }}"> --}}
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
<link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css"  href="{{ asset('css/style.css') }}">

</head>
<body>
    <form method="POST" action="{{ route('password.email_trx') }}">
    @csrf
        <div class="container col-md-8 col-md-offset-2">
            <br/>
            <div class="text-center">
                <a href="{{url('/')}}">
                    <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="300px" height="100px">
                </a>
            </div>
            <hr/>
            <h1>Reset Password Transaksi</h1>
            <a class="btn btn-warning btn-xs" href="{{ url('/member/user/pass_trx') }}" title="Back">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
            </a>
            <p>Masukkan email anda.</p>
            <hr>
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Email Tidak terdaftar.
                </div>
            @endif
            {{-- @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif --}}
            <div class="form-group row">
                <label class="col-md-12" for="email"><b>Email</b></label>
                <div class="col-md-12">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
</body>
    <script src="{{ asset('admin/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('flash_message'))
    <?php $status = (Session::get('flash_status') == 200)?'success':'error';?>
    <?php $status_type = (Session::get('flash_status') == 200)?'Success':'Failed';?>
    <script type="text/javascript">
        swal({   
            type: "{{ $status }}",
            title: "{{ $status_type }}",   
            text: "{{ Session::get('flash_message') }}",   
            showConfirmButton: false ,
            showCloseButton: true,
            footer: ''
        });
    </script>
    @endif
</html>