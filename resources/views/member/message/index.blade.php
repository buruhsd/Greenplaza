@extends('member.index')
@section('pesan & diskusi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Pesan</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white hidden">
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
                    <h4 class="panel-title">Pesan</h4>
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
                                @foreach($message as $item)
                                    <tr colspan="3" scope="row" class="bg-info">
                                        <th class="col-md-3">{{$no++}}. {{ucfirst(strtolower($item->from->name))}}</th>
                                        <th class="col-md-6 text-center">{{$item->message_subject}}</th>
                                        <th class="col-md-3 text-right">{{FunctionLib::date_indo($item->created_at, true, 'full')}}</th>
                                    </tr>
                                    <tr>
                                        <td class="col-md-12 m-b-xs text-break" colspan="3" scope="row">
                                                {{$item->message_text}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" scope="row">
                                            <div class="col-md-12">
                                                @if(isset($_GET['status']) && $_GET['status'] == 'to')
                                                    @if($item->to->user_slug)
                                                        <a href="{{route('member.message.create', $item->to->user_slug)}}" class='btn btn-warning btn-xs'>Send Message to {{$item->to->name}}</a>
                                                    @endif
                                                @elseif(isset($_GET['status']) && $_GET['status'] !== 'arsip')
                                                    @if($item->from->user_slug)
                                                        <a href="{{route('member.message.create', $item->from->user_slug)}}" class='btn btn-warning btn-xs'>Send Message to {{$item->from->name}}</a>
                                                    @endif
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
                    <div> {!! $message->appends(['search' => Request::get('search')])->render() !!} </div>
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
        