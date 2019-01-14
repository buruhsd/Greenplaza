@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Wallet</h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-3"> 
                        <select id="select-list" type="text" class="form-control">
                            <option value="">--Choose Option List--</option>
                            <option value="/admin/monitoring/wallet_memberlist">List Member</option>
                            <option value="/admin/monitoring/wallet_sellerlist">List Seller</option>
                        </select>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>Id</center></th>
                                    <th><center>Detail Member</center></th>
                                    <th><center>Saldo Utama</center></th>
                                    <th><center>Saldo Iklan</center></th>
                                    <th><center>Wallet Type</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                <tr>
                                    <td><center>{{$u->id}}</center></td>
                                    <td><center>
                                        <p>Id :{{$u->id}}</p>
                                        <p>Level : Member</p>
                                        <p>Nama :{{$u->username}}</p></center>
                                    </td>
                                    <td><center>
                                        {{App\Models\Wallet::where('wallet_user_id', $u->id)->first()->wallet_ballance}}</center>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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