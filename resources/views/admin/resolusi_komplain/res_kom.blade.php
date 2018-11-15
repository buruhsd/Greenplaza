@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Resolusi komplain</h3>
            </div>
                <form action="#" method="GET">
                    <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                        <div class="input-group pull-left" style="width: 225px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search" name="search" value="" autocomplete="off" id="search_table_currency">
                        </div>
                      </div> 
                </form>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Resolusi Komplain</h4>
                                </div>
                                 <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-default">Proses Resolusi</button>   
                                  </div>
                                  <div class="btn-group mr-2" role="group" aria-label="Second group">
                                    <button type="button" class="btn btn-warning">Bantuan Admin</button>
                                  </div>
                                  <div class="btn-group" role="group" aria-label="Third group">
                                    <button type="button" class="btn btn-danger">Komplain Selesai</button>
                                  </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
                
@endsection
        