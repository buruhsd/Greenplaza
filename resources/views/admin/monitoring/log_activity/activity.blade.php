@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Admin Activity</h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>Id</center></th>
                                    <th><center>Tanggal</center></th>
                                    <th><center>Activitas Pegawai</center></th>
                                    <th><center>Keterangan</center></th>
                                    <th><center>Id Keterangan</center></th>
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

@endsection
