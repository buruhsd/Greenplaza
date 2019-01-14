@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Iklan Banner Khusus</h3>
    </div>
    <div id="main-wrapper"> 
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Pencarian</h4>
            </div>
            <!-- Search form -->
            <form>
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <div class="panel panel-white">
            <a href="{{route('member.iklan.add_banner_khusus')}}" class="btn btn-default">Post Iklan Banner Khusus</a>
        </div>                        
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Iklan Banner Khusus</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">No</th>
                                        <th>Image</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = ($iklan->currentpage()-1)* $iklan->perpage() + 1;?>
                                    @foreach($iklan as $item)
                                    <tr>
                                        <td scope="row">{{$no++}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <img src="{{asset('assets/images/iklan/'.$item->iklan_image)}}" style="max-height: 100px;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$item->iklan_category_id}}</td>
                                        <td>{{$item->iklan_status}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div> {!! $iklan->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
@endsection