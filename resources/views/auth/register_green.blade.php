<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" type="text/css"  href="{{ asset('frontend/css/reg_style.css') }}">

</head>
<body>



<form method="POST" action="{{ route('register') }}">
    <div class="container">
        <a href="index.html">
            <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="300px" height="100px">
        </a>
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="sponsor"><b>Sponsor</b></label>
        <input name="sponsor" type="text" placeholder="Enter Sponsor" name="sponsor" required>

        <label for="username"><b>Username</b></label>
        <input id="username" type="text" placeholder="Username" name="username" required>

        <label for="name"><b>Nama Lengkap</b></label>
        <input id="name" type="text" placeholder="Nama Lengkap" name="name" required>

        <label for="user_detail_jk"><b>Kelamin</b></label>
        <div class="container">
        <label class="radio-inline"><input type="radio" name="user_detail_jk" value="laki-laki" checked>Laki-Laki</label>
        <label class="radio-inline"><input type="radio" name="user_detail_jk" value="perempuan">Perempuan</label>
        </div><br>

        <label for="user_detail_phone"><b>No. HP</b></label>
        <input id="user_detail_phone" type="text" placeholder="No HP" name="user_detail_phone" required>

        <label for="user_detail_province"><b>Provinsi</b></label>
        <input id="user_detail_province" type="text" placeholder="Provinsi" name="user_detail_province" required>

        <label for="user_detail_city"><b>Kota / Kab.</b></label>
        <input id="user_detail_city" type="text" placeholder="Kota/ Kab." name="user_detail_city" required>

        <label for="user_detail_subdist"><b>Kecamatan</b></label>
        <input id="user_detail_subdist" type="text" placeholder="Kecamatan" name="user_detail_subdist" required>

        <label for="user_detail_pos"><b>Kode Pos</b></label>
        <input id="user_detail_pos" type="text" placeholder="Kode Pos" name="user_detail_pos" required>

        <label for="email"><b>Email</b></label>
        <input id="email" type="text" placeholder="Enter Email" name="email" required>

        <label for="password"><b>Password</b></label>
        <input id="password" type="password" placeholder="Enter Password" name="password" required>

        <label for="password_confirmation"><b>Repeat Password</b></label>
        <input id="password_confirmation" type="password" placeholder="Repeat Password" name="password_confirmation" required>
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
