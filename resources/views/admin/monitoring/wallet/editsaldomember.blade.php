@extends('admin.index')
@section('monitoring', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
	        <div class="page-title">
				<h4 class="breadcrumb-header">Edit Saldo Member</h3>
			</div>
	    	<div class="panel panel-white">
				<div class="panel-heading clearfix">
					<a href="{{route('admin.monitoring.wallet_memberlist')}}"><button class="btn btn-warning btn-addon pull-right"><i class="fa fa-spin fa-refresh"></i> Kembali</button></a>
					<br/>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
								</div>
								<div class="panel-body">
									<form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.updatesaldo', $users->id)}}" enctype = "multipart/form-data">
									{{ csrf_field() }}
										<p>Saldo CW</p>
										<div class="form-group">
											<div class="col-md-9">
												<input type="number" class="form-control hidden" id="input-Default" value="1" name="wallet_type">
												<input type="text" class="form-control" id="input-Default" value="{{$cw->wallet_ballance}}" name="wallet_ballance">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
								</div>
								<div class="panel-body">
									<form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.updatesaldo', $users->id)}}" enctype = "multipart/form-data">
									{{ csrf_field() }}
										<p>Saldo RW</p>
										<div class="form-group">
											<div class="col-md-9">
												<input type="number" class="form-control hidden" id="input-Default" value="2" name="wallet_type">
												<input type="text" class="form-control" id="input-Default" value="{{$rw->wallet_ballance}}" name="wallet_ballance">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div><!-- Row -->
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
								</div>
								<div class="panel-body">
									<form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.updatesaldo', $users->id)}}" enctype = "multipart/form-data">
									{{ csrf_field() }}
										<p>Saldo Transaksi</p>
										<div class="form-group">
											<div class="col-md-9">
												<input type="number" class="form-control hidden" id="input-Default" value="3" name="wallet_type">
												<input type="text" class="form-control" id="input-Default" value="{{$transaksi->wallet_ballance}}" name="wallet_ballance">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									</div>
									<div class="panel-body">
									<form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.updatesaldo', $users->id)}}" enctype = "multipart/form-data">
											{{ csrf_field() }}
										<p>Saldo Iklan</p>
										<div class="form-group">
											<div class="col-md-9">
												<input type="number" class="form-control hidden" id="input-Default" value="4" name="wallet_type">
												<input type="text" class="form-control" id="input-Default" value="{{$iklan->wallet_ballance}}" name="wallet_ballance">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div><!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
								</div>
								<div class="panel-body">
									<form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.updatesaldo', $users->id)}}" enctype = "multipart/form-data">
									{{ csrf_field() }}
										<p>Saldo Pincode</p>
										<div class="form-group">
											<div class="col-md-9">
												<input type="number" class="form-control hidden" id="input-Default" value="5" name="wallet_type">
												<input type="text" class="form-control" id="input-Default" value="{{$pincode->wallet_ballance}}" name="wallet_ballance">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-success" style="width: 100%">Update Saldo</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!-- panel-body -->
			</div>
		</h4>
	</div>
@endsection