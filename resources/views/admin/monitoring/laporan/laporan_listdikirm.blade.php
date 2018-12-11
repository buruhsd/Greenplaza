@extends('admin.index')
@section('content')


<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
		            <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
		            	<div class="col-md-3">
		            		<div class="form-group" style="padding-right: 3%">
			                	<select id="select-list" type="text" name="page_role_id" class="form-control">
		                        	<option value="">--Choose Option Search--</option>
		                        	<option value="">Tanggal Checkout</option>
		                        	<option value="">Tanggal Member Transfer</option>
		                        	<option value="">Tanggal Barang di Kirim</option>
		                        	<option value="">Tanggal Barang Sampai</option>
		                        </select>
			                </div>
		            	</div>
		            	<div class="col-md-3">
		            		<div class="form-group" style="padding-right: 3%">
				                <input type="text" name="email_to" class="form-control" id="" placeholder="Tanggal Mulai">
				            </div>
		            	</div>
		            	<div class="col-md-3">
		            		<div class="form-group" style="padding-right: 3%">
				                <input type="text" name="email_to" class="form-control" id="" placeholder="Tanggal Sampai">
				            </div>
		            	</div>
		            	<div class="col-md-3">
		            		<center><button type="submit" class="btn btn-primary" style="width: 100%">Search</button></center>
		            	</div>
		        	</form>
                </div>
            </div>
            <div class="page-title">
			    <h4 class="breadcrumb-header"><center>Laporan Transaksi Page</center></h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>Id Order Detail</center></th>
                                    <th><center>Detail Waktu</center></th>
                                    <th><center>Detail Barang</center></th>
                                    <th><center>Detail Seller</center></th>
                                    <th><center>Detail Member</center></th>
                                </tr>
                            </thead>
                            @foreach ($detail as $d)
                            <tbody>
                                <tr>
                                	<td>{{$d->id}}</td>
                                	<td></td>
                                	<td>
                                		<center>{{$d->trans_code}}</center> <br/>
                                		<center><img style="width: 20%" src="{{ asset('assets/images/product/'.$d->produk->produk_image) }}" alt=""></center>
                                	</td>
                                	<td></td>
                                	<td></td>
                                	<td></td>

                                </tr>
                            </tbody>
                            @endforeach
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
    $(function(){
        oTable = $('#member-table').DataTable({
              "paging": true,
              "order": [],
              "info": true,
              "oLanguage": { 
                "sSearch": "", 
                "sSearchPlaceholder": "Search..." 
              },
              "dom": "tip"
          });

        $('#search_table_member').keyup(function(){
            oTable.search($(this).val()).draw();
        });
      });
    $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
