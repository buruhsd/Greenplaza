@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix" style="margin-bottom: 2%">
                	<div class="col-md-6">
    	                <a href="{{route('admin.email_sender')}}"><button type="" class="btn btn-default">Kembali</button></a>
    	            </div>
    	            <div class="col-md-6">
    	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	                  	<form action="#" method="GET">
    		                    <div class="input-group pull-right" style="width: 225px;">
    		                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
    		                        <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Subject ..."></a>
    		                    </div>
    	                  	</form>
    	              	</div>
    	            </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
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
                        
                            <tbody>
                        @if($email->count() > 0)
                            @foreach ($email as $e)
                                <tr>
                                    <td>{{$e->created_at}}</td>
                                    @if ($e->email_to != null)
                                    <td>{{$e->email_to}}</td>
                                    @elseif ($e->email_to == null && $e->email_type == 'send for allmember')
                                    <td>Send for All Member</td>
                                    @elseif ($e->email_to == null && $e->email_type == 'send for allseller')
                                    <td>Send for All Seller</td>
                                    @elseif ($e->email_to == null && $e->email_type == 'send for all')
                                    <td>Send for All</td>
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
                                    	<a href="{{route('admin.delete_email', $e->id)}}"><button type="" class="btn btn-danger btn-xs">Delete</button></a>
                                    	<a href="{{route('admin.resend_email', $e->id)}}"><button type="" class="btn btn-info btn-xs">Resend</button></a>

                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <td colspan="8"><center>KOSONG</center></td>
                            @endif
                            </tbody>

                        </table>
                        {{$email->render()}}
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
</div>

@endsection