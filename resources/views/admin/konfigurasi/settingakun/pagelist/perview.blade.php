@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Perview Page</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <a href="{{route('admin.konfigurasi.pagelist')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
            </div>
              <div class="panel-body">
                  <p>{!!$page->page_text!!}</p>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection