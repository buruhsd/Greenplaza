@extends('admin.index')
@section('need approval', 'active-page')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6">
                        <div class="input-group pull-left">
                            <select id="select-list" type="text" class="form-control">
                                <option value="">--Choose Option List--</option>
                                <option value="/admin/needapproval/listmember">List Member</option>
                                <option value="/admin/needapproval/listseller">List Seller</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form action="#" method="GET">
                                <div class="input-group pull-right" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Name Seller ..."></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Member_id</center></th>
                                    <th><center>Name</center></th>
                                    <th><center>Detail</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            @foreach ($users as $key => $u)
                            <tbody>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>
                                        Jenis Kelamin :<br/>
                                        Email : {{$u->email}}<br/>
                                        Alamat : {{$u->user_address->user_address_address}}<br/>
                                        No HP : {{$u->user_address->user_address_phone}}<br/>
                                        No Telp Rumah : {{$u->user_address->user_address_tlp}}<br/>
                                        Kota : {{$u->user_address->user_address_city}}<br/>
                                        Kode_pos : {{$u->user_address->user_address_pos}}<br/>
                                        Propinsi : {{$u->user_address->user_address_province}}<br/>
                                        Kecamatan :<br/>
                                        Tgl Registrasi : {{$u->user_address->created_at}}<br/>
                                        Grade Member :<br/>
                                        Username : {{$u->username}}<br/>
                                        Grade Pajak CW Bonus :
                                    </td>
                                    <td></td>
                                    <td><center>
                                        <a href="{{route('admin.needapproval.changepassword_seller', $u->id)}}"><button type="submit" class="btn btn-success btn-rounded" style="width: 70%; margin-bottom: 1%">Reset Password</button></a><br/>
                                        <a href="{{route('admin.needapproval.detailseller', $u->id)}}"><button type="submit" class="btn btn-primary btn-rounded" style="width: 70%; margin-bottom: 1%">Detail</button></a> <br/>
                                        <!-- <a href="{{route('admin.needapproval.editmember', $u->id)}}"><button type="submit" class="btn btn-warning btn-rounded" style="width: 70%">Update</button></a> --> </center>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {{$users->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
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