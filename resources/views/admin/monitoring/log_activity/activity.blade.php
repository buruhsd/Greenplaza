@extends('admin.index')
@section('monitoring', 'active-page')
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
                                    <th><center>Id Seller</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($log->count() > 0)
                                @foreach ($log as $l)
                               <tr>
                                    <td><center>{{$l->id}}</center></td>
                                    <td><center>{{$l->created_at}}</center></td>
                                    <td><center>{{$l->activity_note}}</center></td>
                                    <td><center>{{$l->activity_user_id}}</center></td>
                                    <td><center>{{$l->actyvity_status}}</center></td>
                               </tr>
                               @endforeach
                            @else
                                <td colspan="5"><center>KOSONG</center></td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
