@extends('admin.index')
@section('masedi', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
			    <h4 class="breadcrumb-header"><center>Wallet Member Greenline</center></h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6">
                        <form action="#" method="GET">
                            <div class="input-group pull-left" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Name ..."></a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group pull-right">
                            <a href="{{route('admin.list_gln')}}"><button class="btn btn-warning btn-xs">Kembali</button></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin-top: 2%">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>User</center></th>
                                    <th><center>Wallet</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            	@foreach($user as $key => $user)
                                <tr>
                                    <td><center>{{$key++}}</center></td>
                                    <td><center>{{$user->name}}</center></td>
                                    <td><center>
                                    	<?php
                                        $response = FunctionLib::gln('ballance', ['address'=>$user->wallet_address]);
                                        if($response['status'] == 200){
                                            echo FunctionLib::number_to_text($response['data']['balance'], 8);
                                        }else{
                                            echo "0,00";
                                        }
                                        ?>     
                                    </center></td>
                                </tr>     
                                @endforeach                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
