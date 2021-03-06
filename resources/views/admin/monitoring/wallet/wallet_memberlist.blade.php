@extends('admin.index')
@section('monitoring', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Wallet Member</h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6"> 
                        <select id="select-list" type="text" class="form-control pull_right">
                            <option value="">--Choose Option List--</option>
                            <option value="/admin/monitoring/wallet_memberlist">List Member</option>
                            <option value="/admin/monitoring/wallet_sellerlist">List Seller</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                    
                            <form action="#" method="GET">
                                <div class="input-group pull-right" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="nama" class="form-control search-input" placeholder="Nama Member ..."></a>
                                </div>
                            </form>
                        
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Detail Member</center></th>
                                    <th><center>Saldo</center></th>
                                    <th><center>Wallet Type</center></th>
                                    {{-- <th><center>Action</center></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $u)
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$u->username}}</center></td>
                                    <td><center>
                                        <p>Id :{{$u->id}}</p>
                                        <p>Level : Member</p>
                                    @if ((App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '7')->first()) != null)
                                        <p>Alamat Wallet : {{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '7')->first()->wallet_address}}</p>
                                    @else
                                        <p>Alamat Wallet : - </p>
                                    @endif
                                    </center>
                                    </td>
                                    <td><center>
                                        Saldo CW :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '1')->first()->wallet_ballance}} <br/>
                                        Saldo RW :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '2')->first()->wallet_ballance}} <br/>
                                        Saldo Transaksi :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '3')->first()->wallet_ballance}} <br/>
                                        Saldo Iklan :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '4')->first()->wallet_ballance}} <br/>
                                        Saldo Pincode :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '5')->first()->wallet_ballance}} <br/>
                                    @if (App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '6')->first())
                                        Saldo Masedi :{{App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '6')->first()->wallet_ballance}} <br/>
                                    @endif
                                    @if (App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '7')->first())
                                        Saldo Greenline :
                                        <?php
                                        $response = FunctionLib::gln('ballance', ['address'=>App\Models\Wallet::where('wallet_user_id', $u->id)->where('wallet_type', '=', '7')->first()->wallet_address]);
                                        if($response['status'] == 200){
                                            echo FunctionLib::number_to_text($response['data']['balance'], 8);
                                        }else{
                                            echo "0,00";
                                        }
                                        ?> <br/>
                                    @endif
                                    </center></td>
                                    <td><center>
                                        CW <br/>
                                        RW <br/>
                                        Transaksi <br/>
                                        Iklan <br/>
                                        Pincode <br/>
                                        Masedi <br/>
                                        Greenline
                                    </center></td>
                                    {{-- <td>
                                        <center><a href="{{route('admin.monitoring.editsaldomember', $u->id)}}"><button class="btn btn-success btn-xs">Edit Saldo</button></a></center>
                                    </td> --}}
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