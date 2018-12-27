@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <!-- <div class="col-md-6">
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
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Kode_Order</center></th>
                                    <th><center>Nama_Seller</center></th>
                                    <th><center>Jumlah_Transfer</center></th>
                                    <th><center>Bank_Tujuan</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            @foreach ($hot as $key => $h)
                            <tbody>
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$h->trans_hotlist_code}}</center></td>
                                    <td><center>{{App\User::where('id', $h->trans_hotlist_user_id)->first()->name}}</center></td>
                                    <td><center>{{$h->trans_hotlist_amount}}</center></td>
                                    <td><center>{{App\Models\Bank::where('id', $h->trans_hotlist_bank_id)->first()->bank_kode}}</center></td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection