@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah Password</h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Ubah Password Transaksi</h4>
                                </div>
                                <div class="panel-body">
                                    {!! Form::open([
                                        'method' => 'POST',
                                        'url' => ['/member/user/pass_trx_update'],
                                        'class' => 'form-horizontal',
                                        'files' => true
                                    ]) !!}
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Password Lama</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="old_password" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="new_password" class="form-control" id="input-default">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Ulangi Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="re_new_password" class="form-control" id="input-default">
                                            </div>
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
        