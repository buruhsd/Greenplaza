@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Withdrawal</h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Withdrawal</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Withdrawal Saldo</label>
                                            <div class="col-sm-10">
                                                <select style="margin-bottom:15px;" class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Input Saldo CW</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-help-block" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-default">
                                                
                                            </div>
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">Withdrawal</button>
                                
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
        