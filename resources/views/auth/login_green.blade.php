<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giplaza | MarketPlace Community</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/gi_plaza.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/style.css') }}">

</head>
<style type="text/css">
    .separator {
    display: flex;
    align-items: center;
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px
    }
    .separator::before, .separator::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }
    .separator::before {
        margin-right: .25em;
    }
    .separator::after {
        margin-left: .25em;
    }
</style>
<body>




<form method="POST" action="{{ route('login') }}">
    @csrf
    @include('layouts._flash')
    <div class="col-md-4 col-md-offset-4">
        <br/>
        <div class="text-center">
            <a href="{{url('/')}}"><br/>
                 <img class="dark-logo" src="{{ asset('assets/images/gi_logo.png') }}" alt="" width="120px" height="40px">
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
            <label class="col-md-12" for="email">Username</label>
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
            <label class="col-md-12" for="password">Password</label>
            <div class="col-md-12">
                <input class="form-control" id="password" type="password" name="password" required>
                <!-- @if ($errors->has('password'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif -->
            </div>
        </div>
        <div style="font-size: 12px">Belum punya akun? <a href="{{ route('register') }}"> Register </a></div><br>
        <button type="submit" class="btn btn-block btn-lg" style="background-color: #33ff67;"><b>Masuk</b></button>
        <div class="separator"> Atau Masuk Dengan
        </div>
        <a href="javascript:void(0)" onClick="showLoginModal()" class="btn btn-lg btn-google btn-block text-uppercase" style="background-color: #bac8bd; color: #fff;" type="submit"><img class="dark-logo" src="{{ asset('assets/images/gi-ori.png')}}" alt="" width="40px" height="40px"><b> Sign in with GI Community </b></a>
        <a href="#"  class="btn btn-lg btn-google btn-block text-uppercase" style="background-color: #bac8bd; color: #fff;" type="submit"><img class="dark-logo" src="{{ asset('assets/images/google-plus.png')}}" alt="" width="40px" height="40px"><b> Sign in with Gmail </b></a>
        {{-- <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> --}}
        <br/>
    </div>
</form>

<div style="padding: 0px; margin-top: 2%" id="myModalLogin" class="modal fade" role="dialog">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body" style="margin-top: 18%">
            <br>
            <div class="text-center">
               <div class="text-center">
                  <img class="dark-logo" src="{{ asset('assets/images/gi_logo.png') }}" alt="" width="120px" height="40px">
               </div>
               <br>
            </div>
            <br> 
            <form action="#" id="formData" class="form-horizontal container col-md-12" >
               <span id="feedbackdata"></span>
               @csrf
               <div class="form-group">
                  <label for="username">username GI</label>
                  <input type="text" class="form-control m-input remove-border-focus" name="email" />
                  <span id="feedbackusername"></span>
               </div>
               <div class="form-group">
                  <label for="password">password GI</label>
                  <input class="form-control m-input remove-border-focus" type="password" name="password"/>
                  <span id="feedbackpassword"></span>
               </div>
               <div style="font-size: 12px">{{__('front.akun') }}? <a href="https://gicommunity.org/register">{{__('front.daftar') }} </a></div>
               <div class="pull-right" style="padding: 1.5rem 0;">
                  <a style="cursor: pointer; font-size: 14px; color: #fff" onclick="saveLogin()" class="btn btn-success btnsave">{{__('front.login') }}</a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a style="cursor: pointer; font-size: 14px;" class="btn btn-metal" data-dismiss="modal">{{__('front.tutup') }}</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
</script>
    <script >
        function showLoginModal(){
            $('.remove-border-focus').attr("style", "outline: 0px !important");
            $('.remove-border-focus').attr("style", "-webkit-appearance: none");
            $('.remove-border-focus').attr("style", "box-shadow: none !important");
            $('#myModalLogin').modal('show');
        }
        function saveLogin(){
            $('.btnsave').html("load...");
            $('.btnsave').addClass("disabled").prop('disabled', true);
            var dataString = $("#formData").serialize();
            $.ajax({
                url : "{{ url('/login_gi') }}",
                type: "POST",
                data: dataString,
                dataType: "JSON",
                success: function(data){
                 if(data.sucess){
                    location.reload();
                 }
                 (!data.error.email) ?
                 $("#feedbackusername").html('') : $("#feedbackusername").html('<span style="font-size: 12px; color: #ed5249">' + data.error.email[0] +'</span>');
                 (!data.error.password) ?
                 $("#feedbackpassword").html('') : $("#feedbackpassword").html('<span style="font-size: 12px; color: #ed5249">' + data.error.password[0] +'</span>');
                 (!data.error.data) ?
                 $("#feedbackdata").html('') : $("#feedbackdata").html('<div class="alert alert-danger text-center" role="alert">' + data.error.data +'</div>');
                 $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);

                },
                error: function (err){
                    console.log(err.error);
                    $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);
                }
            });
        }
    </script>
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
    {{-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5cbe8a7ad6e05b735b43c9e3/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script> --}}
    <!--End of Tawk.to Script-->
</html>
