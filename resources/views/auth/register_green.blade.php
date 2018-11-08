<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" type="text/css"  href="{{ asset('frontend/css/reg_style.css') }}">

</head>
<body>



<form action="/action_page.php">
  <div class="container">
    <a href="index.html">
        <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="300px" height="100px">
    </a>
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Sponsor</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Nama Lengkap</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Kelamin</b></label>
    <div class="container">
    <label class="radio-inline"><input type="radio" name="optradio" checked>Laki-Laki</label>
    <label class="radio-inline"><input type="radio" name="optradio">Perempuan</label>
    </div><br>
    
    <label for="email"><b>No. HP</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Provinsi</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Kota / Kab.</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Kecamatan</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Kode Pos</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
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
