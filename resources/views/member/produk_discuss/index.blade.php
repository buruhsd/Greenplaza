@extends('member.index')
@section('pesan & diskusi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Diskusi Produk</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  {{-- <div class="form-group mx-sm-3 mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Search" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
                  </div> --}}
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="from" {!! (!empty($_GET['status']) && $_GET['status'] == "from")?"selected":"" !!}>Inbox</option>
                        <option value="to" {!! (!empty($_GET['status']) && $_GET['status'] == "to")?"selected":"" !!}>Active</option>
                        <option value="arsip" {!! (!empty($_GET['status']) && $_GET['status'] == "arsip")?"selected":"" !!}>Block</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Diskusi Produk</h4>
                    <button type="button" onclick="search('from');" class="btn btn-danger">
                        <i class="fa fa-arrow-down"></i> Inbox
                        <span class="label label-default pull-right"></span>
                    </button>
                    <button type="button" onclick="search('to');" class="btn btn-info">
                        <i class="fa fa-arrow-up"></i> Outbox
                        <span class="label label-default pull-right"></span>
                    </button>
                    <button type="button" onclick="search('arsip');" class="btn btn-warning">
                        <i class="fa fa-folder"></i> Arsip
                        <span class="label label-default pull-right"></span>
                    </button>
                    {{-- <a href="{{ url('member/produk/create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Request Product</a> --}}
                </div>
                <br/>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-highlight">
                            <thead></thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($produk_discuss as $item)
                                    <tr>
                                        <td class="col-md-12 m-b-xs text-break" colspan="3" scope="row">
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-rounded h100" src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" onerror="">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading">By {{$item->user->name}}</h4>
                                                    <p class="text-left">{{$item->produk->produk_name}}</p>
                                                    <p>{{$item->produk_discuss_text}}</p>
                                                    <ul class="list-inline list-unstyled">
                                                        <li><span><i class="glyphicon glyphicon-calendar"></i> {{FunctionLib::datetime_indo($item->created_at, true, 'full')}} </span></li>
                                                        <li>|</li>
                                                        <a data-toggle="collapse" href="#comments-{{$item->id}}" role="button" aria-expanded="false" aria-controls="comments-{{$item->id}}"><i class="glyphicon glyphicon-comment"></i> {{$item->reply->count()}} comments</a>
                                                    </ul>
                                                    <div class="col-md-12 panel collapse" id="comments-{{$item->id}}">
                                                        <table class="row">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($item->reply as $reply)
                                                                <tr>
                                                                    <td>
                                                                        <a class="pull-left" href="#">
                                                                            <img class="media-object img-rounded h100" src="{{asset('assets/images/profil/'.$reply->user->user_detail->user_detail_image)}}" onerror="">
                                                                        </a>
                                                                        <div class="media-body">
                                                                            <h4 class="media-heading">By {{$reply->user->name}}</h4>
                                                                            <p>{{$reply->produk_discuss_reply_text}}</p>
                                                                            <ul class="list-inline list-unstyled">
                                                                                <li><span><i class="glyphicon glyphicon-calendar"></i> {{FunctionLib::datetime_indo($item->created_at, true, 'full')}} </span></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                               </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" scope="row">
                                            <div class="col-md-12">
                                                @if(isset($_GET['status']) && $_GET['status'] == 'to')
                                                    <a href="{{route('member.message.arsip', $item->id)}}" class='btn btn-warning btn-xs'>Balas {{$item->message_to_id}}</a>
                                                @elseif(isset($_GET['status']) && $_GET['status'] !== 'arsip')
                                                    <a href="{{route('member.message.arsip', $item->id)}}" class='btn btn-warning btn-xs'>Balas {{$item->message_from_id}}</a>
                                                @elseif($item->message_from_id !== Auth::id() && $item->message_to_id == Auth::id() )
                                                    <a href="{{route('member.message.arsip', $item->id)}}" class='btn btn-warning btn-xs'>Balas {{$item->message_from_id}}</a>
                                                @endif
                                                <a href="{{route('member.message.arsip', $item->id)}}" class='btn btn-warning btn-xs'>Arsip</a>
                                                <a href="{{route('member.message.destroy', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $produk_discuss->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
        