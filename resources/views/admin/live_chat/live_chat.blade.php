@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Live Chat</h3>
            </div>
                <form action="#" method="GET">
                    <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                        <div class="input-group pull-left" style="width: 225px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search" name="search" value="" autocomplete="off" id="search_table_currency">
                        </div>
                      </div> 
                </form>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <b>username : {{FunctionLib::get_config('username_tawk')}}, Password : {{FunctionLib::get_config('password_tawk')}}</span>
                                    <iframe name="main" style="display: block;background: #000;border: none;height: 100vh;width: 100%;" id="main" src="https://dashboard.tawk.to" frameborder="0" align="left"><FONT FACE=ARIAL SIZE=3 COLOR="RED">Your Browser doesn't Support Required Component.</FONT></iframe>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
                
@endsection
        