<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" type="text/css"  href="{{ asset('frontend/css/reg_style.css') }}">

</head>
<body>



<form method="POST" action="{{ route('register') }}">
    @csrf
    @include('layouts._flash')
    <div class="container">
        <a href="{{url('/')}}">
            <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="300px" height="100px">
        </a>
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div class="form-group row">
            <label for="sponsor"><b>Sponsor</b></label>
            <div class="col-md-12">
                <input name="sponsor" type="text" placeholder="Enter Sponsor" name="sponsor" required>
                @if ($errors->has('sponsor'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sponsor') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="username"><b>Username</b></label>
            <div class="col-md-12">
                <input id="username" type="text" placeholder="Username" name="username" required>
                @if ($errors->has('usernamename'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="name"><b>Nama Lengkap</b></label>
            <div class="col-md-12">
                <input id="name" type="text" placeholder="Nama Lengkap" name="name" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_jk"><b>Kelamin</b></label>
            <div class="col-md-12">
                <div class="container">
                <label class="radio-inline"><input type="radio" name="user_detail_jk" value="laki-laki" checked>Laki-Laki</label>
                <label class="radio-inline"><input type="radio" name="user_detail_jk" value="perempuan">Perempuan</label>
                </div><br>
                @if ($errors->has('user_detail_jk'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_jk') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_phone"><b>No. HP</b></label>
            <div class="col-md-12">
                <input id="user_detail_phone" type="text" placeholder="No HP" name="user_detail_phone" required>
                @if ($errors->has('user_detail_phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_province"><b>Provinsi</b></label>
            <div class="col-md-12">
                <input id="user_detail_province" type="text" placeholder="Provinsi" name="user_detail_province" required>
                @if ($errors->has('user_detail_province'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_province') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_city"><b>Kota / Kab.</b></label>
            <div class="col-md-12">
                <input id="user_detail_city" type="text" placeholder="Kota/ Kab." name="user_detail_city" required>
                @if ($errors->has('user_detail_city'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_city') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_subdist"><b>Kecamatan</b></label>
            <div class="col-md-12">
                <input id="user_detail_subdist" type="text" placeholder="Kecamatan" name="user_detail_subdist" required>
                @if ($errors->has('user_detail_subdist'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_subdist') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="user_detail_pos"><b>Kode Pos</b></label>
            <div class="col-md-12">
                <input id="user_detail_pos" type="text" placeholder="Kode Pos" name="user_detail_pos" required>
                @if ($errors->has('user_detail_pos'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_pos') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email"><b>Email</b></label>
            <div class="col-md-12">
                <input id="email" type="text" placeholder="Enter Email" name="email" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password"><b>Password</b></label>
            <div class="col-md-12">
                <input id="password" type="password" placeholder="Enter Password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation"><b>Repeat Password</b></label>
            <div class="col-md-12">
                <input id="password_confirmation" type="password" placeholder="Repeat Password" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <hr>
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>

</body>
</html>
