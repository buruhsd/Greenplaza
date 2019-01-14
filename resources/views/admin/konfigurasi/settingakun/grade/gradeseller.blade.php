@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
    <div class="col-md-6">
        <h3 class="breadcrumb-header"><i class="fa fa-check-square"></i>Setting Grade</h3>
    </div>
    <div class="col-md-6">
      <div class="input-group pull-right">
        <select id="select-grade" type="text" class="form-control">
            <option value="">--Choose Option Setting Grade--</option>
            <option value="/admin/konfigurasi/grademember">Grade Member</option>
            <option value="/admin/konfigurasi/gradeseller">Grade Seller</option>
        </select>
      </div>
    </div>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <p>Tambah Grade Seller</p>
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.add_gradeseller')}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="form-group">
                            <div class="col-md-5">
                              <input type="text" class="form-control" id="input-Default" placeholder="grade" name="grade_member_name">
                          </div>
                          <div class="col-md-5">
                              <input type="text" class="form-control" id="input-Default" placeholder="nilai" name="grade_member_range">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                      </div>
                  </form>
                  <p>Isikan nama grade dan nilai grade. <br/>
                    Contoh : <br/>
                    <strong>Grade A</strong> dengan nilai grade <strong>Rp 1.000.000,00</strong> <br/>
                    Akun yang memiliki nilai total transaksi minimal Rp 1.000.000 akan mendapat grade A.</p>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <p>Update Grade</p>
            </div>
              <div class="panel-body">
                @if($grade->count() > 0)
                @foreach ($grade as $key => $g)
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.update_gradeseller', $g->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                    
                      <div class="form-group">
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="input-Default" value="{{$g->grade_member_name}}" name="grade_member_name">
                          </div>
                          <div class="col-md-4">
                              <input type="text" class="form-control" id="input-Default" value="{{$g->grade_member_range}}" name="grade_member_range">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary" style="width: 100%">Save Update</button>
                          </div>
                          <div class="col-sm-2">
                              <a href="{{route('admin.konfigurasi.delete_gradeseller', $g->id)}}"><button type="button" class="btn btn-danger" style="width: 100%">Hapus</button></a>
                          </div>
                      </div>
                  </form>
                @endforeach
                @else
                <center><button class="btn btn-danger btn-rounded">KOSONG</button></center>
                @endif
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>
@endsection

@section('script')
<script type="text/javascript">
  $('#select-grade').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection