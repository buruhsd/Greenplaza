@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="page-title">
            <h4 class="breadcrumb-header">Banner Khusus</h3>
        </div>
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6"> 
                        <select id="select-banner" type="text" class="form-control">
                            <option value="">--Choose Banner List--</option>
                            <option value="/admin/needapproval/banner_khusus">Banner Khusus</option>
                            <option value="/admin/needapproval/banner_seller">Banner Seller</option>
                            <option value="/admin/needapproval/banner_pembeli">Banner Pembeli</option>
                            <option value="/admin/needapproval/banner_slider">Banner Slider</option>
                        </select>
                    </div>
                    <div class="col-md-6"> 
                        <select id="select-baris" type="text" class="form-control">
                            <option value="">--Choose Baris List--</option>
                            <option value="/admin/needapproval/baris_pembeli">Baris Pembeli</option>
                            <option value="/admin/needapproval/baris_seller">Baris Seller</option>
                        </select>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Id_Iklan</center></th>
                                    <th><center>Judul_Iklan</center></th>
                                    <th><center>Detail_Iklan</center></th>
                                    <th><center>Username_Pembeli</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $('#select-banner').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
<script type="text/javascript">
  $('#select-baris').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection