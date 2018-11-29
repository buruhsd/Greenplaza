@extends('admin.index')
@section('content')

@include('layouts._flash')
<div class="col-md-12">
    <div class="panel-body">
    	<div class="col-md-12">
            <div class="panel panel-white">
            	<div class="col-md-6">
	                <div class="panel-heading clearfix">
	                    <h4 class="panel-title">List Email</h4>
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
	            </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Created_at</th>
                                <th>Send_to</th>
                                <th>Sender</th>
                                <th>Email_subject</th>
                                <th>Email_type</th>
                                <th>Email_text</th>
                                <th>Resend</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($email as $e)
                        <tbody>
                            <tr>
                                <td>{{$e->created_at}}</td>
                                @if ($e->email_to != null)
                                <td>{{$e->email_to}}</td>
                                @else
                                <td>Kiri ke Semua</td>
                                @endif
                                <td>{{$e->email_from}}</td>
                                <td>{{$e->email_subject}}</td>
                                <td>{{$e->email_type}}</td>
                                <td>{{$e->email_text}}</td>
                                @if ($e->is_send == 0)
                                <td>Belum Pernah</td>
                                @else 
                                <td>Sudah Pernah</td>
                                @endif
                                <td>
                                	<a href="{{route('admin.delete_email', $e->id)}}"><button type="" class="btn btn-danger btn-rounded">Delete</button></a>
                                	<a href="{{route('admin.resend_email', $e->id)}}"><button type="" class="btn btn-info btn-rounded">Resend</button></a>

                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    {{$email->render()}}
                </div>
            </div>
         </div>
    </div>
</div>

@endsection