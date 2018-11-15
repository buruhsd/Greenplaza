@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Dashboard</h3>
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
                    
                                
                                       <textarea class="form-control" id="article-ckeditor" name="description" placeholder="Post" rows="4"></textarea>
                                   
                            
                </div>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' , {
            height: 400,
            
        });
    </script>            
                
@endsection
        