@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">{{__('front.notif') }}</h3>
                    </div>
                    <div class="panel-body">
                    </div>
                    <div id="main-wrapper"> 
                        {{-- <div class="panel panel-white">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Pencarian</h4>
                            </div>
                            
                            <form>
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                            </form>
                        </div>      --}}            
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">{{__('dashboard.notif') }}</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive invoice-table">
                                            <?php 
                                                $notif = FunctionLib::user_notif_all(Auth::id(), 10);
                                             ?>
                                             {{-- {{ dd($notif)}} --}}
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('front.notif') }}</th>
                                                        <th>{{__('dashboard.date') }}</th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if($notif->count())
                                                        @foreach($notif->get() as $item) 
                                                        <?php
                                                           $data = json_decode($item->data,true);
                                                           ?>       
                                                        {{-- {{dd($data)}} --}}
                                                    <tr>
                                                           
                                                        <td>
                                                        <a href="{{route('member.notification.is_read', $item->id)}}">
                                                            @if($item->read_at)
                                                               <small class="text-sm text-success">
                                                               <i class="fa fa-check animated"></i>
                                                               </small>
                                                            @endif
                                                            {{$data['data']['title']}} {{$data['data']['message']}}
                                                        </a>
                                                        </td>
                                                        <td>{{$data['item']['created_at']}}</td>
                                                        
                                                        
                                                    </tr>
                                                        @endforeach
                                                @else
                                                <td>{{__('dashboard.kosong') }}</td>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div>
@endsection
                                   
        
                                        
                                           

                                