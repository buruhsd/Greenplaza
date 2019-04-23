@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Live Chat</h3>
            </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <b>
                                        username : {{FunctionLib::get_config('profil_username_tawk')}}, 
                                        Password : {{FunctionLib::get_config('profil_password_tawk')}}
                                    </b>
                                    <button class="btn btn-info btn-xs pull-right" onclick="openFullscreen('tawk')"><i class="icon-fullscreen"></i> Fullscreen</button>
                                    <iframe id="tawk" name="main" style="display: block;background: #000;border: none;height: 100vh;width: 100%;" id="main" src="https://dashboard.tawk.to" frameborder="0" align="left"><FONT FACE=ARIAL SIZE=3 COLOR="RED">Your Browser doesn't Support Required Component.</FONT></iframe>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
                
@endsection
        