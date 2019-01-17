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



<form method="POST" action="{{ route('register') }}">
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
        <h1>Pendaftaran</h1>
        <p>Lengkapi form di bawah untuk membuat akun baru.</p>
        <hr>
        {{-- <div class="form-group row col-lg-12 columns bg-warning text-white hidden">
            <label class="col-md-12" for="sponsor">Pilih salah satu penjual sebagai sponsor anda, atau silakan isi Username sponsor anda sendiri.<br>
            Sponsor boleh dikosongkan.</label>
            <div class="col-md-12">
                <ul class="ds-btn">
                    @foreach($sponsor as $item)
                        <li class="col-md-4">
                            <a class="btn btn-lg btn-primary" onClick="get_sponsor()">
                                <i class="glyphicon glyphicon-user pull-left"></i>
                                <span>
                                    {{$item->name}}<br>
                                    <small>
                                        Bergabung sejak<br>
                                        {{FunctionLib::date_indo($item->created_at, true, 'full')}}
                                    </small>
                                </span>
                            </a> 
                        </li>
                    @endforeach
                </ul>
            </div>
        </div> --}}
        {{-- <div class="form-group row hidden">
            <label class="col-md-12" for="sponsor"><b>Sponsor</b></label>
            <div class="col-md-12">
                <input class="form-control" name="sponsor" type="text" placeholder="Enter Sponsor" name="sponsor" required>
                @if ($errors->has('sponsor'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sponsor') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}

        <div class="form-group row">
            <label class="col-md-12" for="username"><b>Username</b></label>
            <div class="col-md-12">
                <input class="form-control" id="username" type="text" placeholder="Username" name="username" required>
                @if ($errors->has('usernamename'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="name"><b>Nama Lengkap</b></label>
            <div class="col-md-12">
                <input class="form-control" id="name" type="text" placeholder="Nama Lengkap" name="name" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('user_detail_jk') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_jk', 'Gender', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-12 text-left">
                <div class="container">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="user_detail_jk" value="laki-laki" autocomplete="off" checked >
                            Laki-Laki <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="user_detail_jk" value="perempuan" autocomplete="off" >
                            Perempuan <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                    </div>
                </div>
            {!! $errors->first('user_detail_jk', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="user_detail_phone"><b>No. HP</b></label>
            <div class="col-md-12">
                <input class="form-control" id="user_detail_phone" type="text" placeholder="No HP" name="user_detail_phone" required>
                @if ($errors->has('user_detail_phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_detail_phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                {!! Form::label('user_detail_province', 'Provinsi', ['class' => 'col-md-12']) !!}
                <div class="form-group {{ $errors->has('user_detail_province') ? 'has-error' : ''}}">
                    <div class="col-md-12">
                        <select name='user_detail_province' id='user_detail_province' class="form-control" onchange="get_city(this.value);">
                        </select>
                        {!! $errors->first('user_detail_province', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::label('user_detail_city', 'Kota / Kabupaten', ['class' => 'col-md-12']) !!}
                <div class="form-group {{ $errors->has('user_detail_city') ? 'has-error' : ''}}">
                    <div class="col-md-12">
                        <select name='user_detail_city' id='user_detail_city' class="form-control" onchange="get_subdistrict(this.value);">
                            {{-- @foreach($city as $item)
                                <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                            @endforeach --}}
                        </select>
                        {!! $errors->first('user_detail_city', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::label('user_detail_subdist', 'Desa / Kelurahan', ['class' => 'col-md-12']) !!}
                <div class="form-group {{ $errors->has('user_detail_subdist') ? 'has-error' : ''}}">
                    <div class="col-md-12">
                        <select name='user_detail_subdist' id='user_detail_subdist' class="form-control">
                            {{-- @foreach($subdistrict as $item)
                                <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                            @endforeach --}}
                        </select>
                        {!! $errors->first('user_detail_subdist', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::label('user_detail_pos', 'Kode Pos', ['class' => 'col-md-12']) !!}
                <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_pos') ? 'has-error' : ''}}">
                    <div class="col-md-12">
                        {!! Form::text('user_detail_pos', null, [
                            'class' => 'form-control', 
                            'placeholder' => 'Postal Code', 
                            'required'
                        ])!!}
                    {!! $errors->first('user_detail_pos', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="email"><b>Email</b></label>
            <div class="col-md-12">
                <input class="form-control" id="email" type="text" placeholder="Enter Email" name="email" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="password"><b>Password</b></label>
            <div class="col-md-12">
                <input class="form-control" id="password" type="password" placeholder="Enter Password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12" for="password_confirmation"><b>Repeat Password</b></label>
            <div class="col-md-12">
                <input class="form-control" id="password_confirmation" type="password" placeholder="Repeat Password" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <hr>
        <p>Dengan membuat akun Anda setuju dengan <a href="#">Ketentuan & Privasi kami</a>.</p>

        <button type="submit" class="btn btn-success btn-block">Register</button>
        {{-- <button type="submit" class="registerbtn">Register</button> --}}
        <p>Sudah punya akun? <a href="{{url('/login')}}">Login</a>.</p>
    </div>
</form>

</body>
    <script src="{{ asset('admin/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        function get_sponsor(){
            alert('sip');
        }
        $(function(){
            var rows, row;
            get_province();
        });
        function get_province(){
            $.ajax({
                type: "GET", // or post?
                url: "<?php echo url('localapi/content/get_province', 0);?>", // change as needed
                beforeSend: function(){
                    rows = "<option>Loading...</option>";
                    $('#user_detail_province').empty();
                    $('#user_detail_province').html(rows);
                },
                success: function(data) {
                    if (data) {
                        $('#user_detail_province').empty();
                        $.each( data.province, function(i, o){
                            $check = "";
                            row = "<option value="+o.province_id+" "+$check+">"+
                                o.province+"</option>";
                            $('#user_detail_province').append(row);
                            if(i == 0){
                                get_city(o.province_id);
                            }
                        });
                    } else {
                        swal({   
                            type: "error",
                            title: "failed",   
                            text: "Layanan Tidak Tersedia",   
                            showConfirmButton: false ,
                            showCloseButton: true,
                            footer: ''
                        });
                    }
                    // $("#btn-choose-shipment").val(text);
                },
                error: function(xhr, textStatus) {
                    swal({
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                    $("#btn-choose-shipment").val(text);
                }
            });
        }
        function get_city(id = 0){
            $.ajax({
                type: "GET", // or post?
                url: "<?php echo url("localapi/content/get_city"); ?>/"+id, // change as needed
                beforeSend: function(){
                    rows = "<option>Loading...</option>";
                    $('#user_detail_city').empty();
                    $('#user_detail_city').html(rows);
                },
                success: function(data) {
                    if (data) {
                        $('#user_detail_city').empty();
                        $.each( data.city, function(i, o){
                            $check = "";
                            row = "<option value="+o.city_id+" "+$check+">"+o.city_name+"</option>";
                            $('#user_detail_city').append(row);
                            if(i == 0){
                                get_subdistrict(o.city_id);
                            }
                        });
                    } else {
                        swal({   
                            type: "error",
                            title: "failed",   
                            text: "Layanan Tidak Tersedia",   
                            showConfirmButton: false ,
                            showCloseButton: true,
                            footer: ''
                        });
                    }
                    // $("#btn-choose-shipment").val(text);
                },
                error: function(xhr, textStatus) {
                    swal({
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                    $("#btn-choose-shipment").val(text);
                }
            });
        }
        function get_subdistrict(id){
            $.ajax({
                type: "GET", // or post?
                url: "<?php echo url("localapi/content/get_subdistrict");?>/"+id, // change as needed
                beforeSend: function(){
                    rows = "<option>Loading...</option>";
                    $('#user_detail_subdist').empty();
                    $('#user_detail_subdist').html(rows);
                },
                success: function(data) {
                    if (data) {
                        $('#user_detail_subdist').empty();
                        $.each( data, function(i, o){
                            $check = "";
                            row = "<option value="+o.subdistrict_id+" "+$check+">"+o.subdistrict_name+"</option>";
                            $('#user_detail_subdist').append(row);
                        });
                    } else {
                        swal({   
                            type: "error",
                            title: "failed",   
                            text: "Layanan Tidak Tersedia",   
                            showConfirmButton: false ,
                            showCloseButton: true,
                            footer: ''
                        });
                    }
                    // $("#btn-choose-shipment").val(text);
                },
                error: function(xhr, textStatus) {
                    swal({
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                    $("#btn-choose-shipment").val(text);
                }
            });
        }
    </script>
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
