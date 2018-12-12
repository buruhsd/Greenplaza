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
                                    <th><center>Saldo</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><center>{{$seller->id}}</center></td>
                                    <td><center>
                                        <p>Id :{{$seller->id}}</p>
                                        <p>Level : Member</p>
                                        <p>Nama :{{$seller->username}}</p></center>
                                    </td>
                                    <td>{{App\Models\Wallet::where($seller->id, 'wallet_user_id')->first()}}</td>
                                    <td></td>
                                </tr>
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