<div class="page-header">
    <div class="search-form">
        <form action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="close-search" type="button"><i class="icon-close"></i></button>
                </span>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="logo-sm">
                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                    {{-- <a class="logo-box" href="index.html"><span>Space</span></a> --}}
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <i class="fa fa-angle-down"></i>
                </button>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
        
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                    <li style="margin: 15px;"><form action="{{url('category')}}" method="GET">
                            <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                                <div class="input-group pull-left" style="width: 500px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Cari Nama Produk" name="src" value=""  id="search_table_currency">
                                </div>
                              </div> 
                        </form>
                        </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {{-- <li><a href="javascript:void(0)" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><i class="fa fa-envelope"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                        <ul class="dropdown-menu dropdown-lg dropdown-content">
                            <li class="drop-title">Notifications<a href="#" class="drop-title-link"><i class="fa fa-angle-right"></i></a></li>
                            <li class="slimscroll dropdown-notifications">
                                <ul class="list-unstyled dropdown-oc">
                                    <li>
                                        <a href="#"><span class="notification-badge bg-primary"><i class="fa fa-photo"></i></span>
                                            <span class="notification-info">Finished uploading photos to gallery <b>"South Africa"</b>.
                                                <small class="notification-date">20:00</small>
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="notification-badge bg-primary"><i class="fa fa-at"></i></span>
                                            <span class="notification-info"><b>John Doe</b> mentioned you in a post "Update v1.5".
                                                <small class="notification-date">06:07</small>
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="notification-badge bg-danger"><i class="fa fa-bolt"></i></span>
                                            <span class="notification-info">4 new special offers from the apps you follow!
                                                <small class="notification-date">Yesterday</small>
                                            </span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="notification-badge bg-success"><i class="fa fa-bullhorn"></i></span>
                                            <span class="notification-info">There is a meeting with <b>Ethan</b> in 15 minutes!
                                                <small class="notification-date">Yesterday</small>
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="dropdown user-dropdown">
                        <?php 
                            $notif = FunctionLib::user_notif(Auth::id(), 10);
                        ?>
                        <a href="#" id="admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell animated"></i>
                            <small class="text-danger {!!($notif->count())?'':'hide'!!}">
                                <i class="fa fa-exclamation-triangle {!!($notif->count())?'faa-vertical':''!!} animated"></i>
                            </small>
                        </a>
                        <ul class="dropdown-menu list-group" id="admin-notif">
                            @if($notif->count())
                                @foreach($notif->get() as $item)
                                    <?php
                                        $data = json_decode($item->data,true);
                                    ?>
                                    <li>
                                        <a href="{{route('member.notification.is_read', $item->id)}}">
                                            @if($item->read_at)
                                                <small class="text-sm text-success">
                                                    <i class="fa fa-check animated"></i>
                                                </small>
                                            @endif
                                            <strong>{{$data['data']['title']}}</strong>  <small>{{$data['data']['message']}}</small>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="dropdown-header" id="no-notif">
                                    <small class="text-sm text-success">
                                        <i class="fa fa-check animated"></i>
                                    </small>
                                    No notifications
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li style="margin-right: -30px"><a href="">{{Auth::user()->name}}</a></li>
                    <li class="dropdown user-dropdown">
                        @if (\Auth::check())
                            @if (Auth::user()->user_detail->user_detail_image != null)
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="text-transform: capitalize;"> &nbsp;&nbsp;</span>
                            <img src="{{asset('assets/images/profil/'.Auth::user()->user_detail->user_detail_image)}}"" class="img-round" onerror="this.src='{{ asset('assets/images/profil/nopic.png') }}'"></a>
                            @else
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="text-transform: capitalize;"> &nbsp;&nbsp;</span><img src="http://via.placeholder.com/36x36" alt="" class="img-circle"></a>
                            @endif
                        @else
                        @endif
                        <ul class="dropdown-menu">
                            <li><a href="{{route('member.profil')}}">Profil</a></li>
                            {{-- <li><a href="#">Calendar</a></li>
                            <li><a href="#"><span class="badge pull-right badge-danger">42</span>Messages</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Account Settings</a></li> --}}
                            <li>
                                <a onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div><!-- /Page Header -->
