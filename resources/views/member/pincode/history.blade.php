@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">List Pin Code </h3>
</div>
<div class="panel-body">
</div>
<div id="main-wrapper">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Pencarian</h4>
        </div>
        <form>
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">List Pin Code</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive invoice-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">No</th>
                                    <th>Pin Kode Iklan</th>
                                    <th>Iklan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = ($pincode->currentpage()-1)* $pincode->perpage() + 1;?>
                                @foreach($pincode as $item)
                                <tr>
                                    <th>{{$no++}}</th>
                                    <td>{{$item->pincode_code}}</td>
                                    <td>{{($item->pincode_iklan_id > 0)?$item->iklan->trans->trans_iklan_code:'Belum Terpakai.'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div> {!! $pincode->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div>
@endsection
                                   
        
                                        
                                           

                                