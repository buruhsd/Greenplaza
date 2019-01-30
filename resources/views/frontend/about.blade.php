@extends('frontend.layout.indexall')
@section('title', 'Page Title')
@section('content')
<body>
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-5" src="">
                        <div class="breadcumb-content black-opacity" style="background-image: url({{asset("images/header_page/")}});background-size: 100% 100%;">
                            <h2></h2>
                            <ul>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-details-area start-->
    <div class="blog-details-area mb-30">
        <div class="container">
            <div class="col-lg-12 col-12 blog-details-wrap p-10 bg-5 mb-30">
                <h4>Tentang Greenplaza</h4>
                <p><strong>Keterangan:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>
                @foreach($page as $item)
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    {{$item->page_judul}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                {!!$item->page_text!!}
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}