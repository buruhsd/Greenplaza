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
    <a class="gp" href="index.html" >
        <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" width="100px" height="50px" >
    </a>
    <h2>Login</h3>
    <p>Belum Punya Akun ? <a href="#"> Daftar disini </a>.</p>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <hr>

    <button type="submit" class="registerbtn">Login</button>
    <p><a href="#">Lupa Password</a>.</p>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
