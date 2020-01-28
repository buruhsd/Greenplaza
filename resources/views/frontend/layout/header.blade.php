    <header class="header-area header-req">
        <div class="header-middle-area bg-1">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                   <div style="margin-right: 3rem">
                       <a href="{{url("/")}}">
                                <img width="130px" height="40px" class="dark-logo" src="{{ asset('frontend/images/logo-fix-2.png') }}" alt="" >
                            </a>
                   </div>
                   <form style="width: 32rem" action="{{route('category')}}" method="GET" class="d-flex justify-content-between align-items-center">
                                <input name="cat" class="form-control" type="hidden" value="{{(isset($_GET['cat']))?$_GET['cat']:''}}">
                                <input name="src" class="form-control" type="text" placeholder="Produk" aria-label="produk" aria-describedby="basic-addon2" value="{{(isset($_GET['src']))?$_GET['src']:''}}">
                              <div class="input-group-append">
                                <button class="btn"><i class="fa fa-search"></i></button>
                              </div>
                        
                    </form>
                </div>
                <div class="p-2 bd-highlight">
                     <ul class="mainmenu d-flex">
                            @guest
                            @else
                                <li>
                                    <?php 
                                        $notif = FunctionLib::user_notif(Auth::id(), 10);
                                    ?>
                                    <a href="#" id="member" onclick="drop()" class="dropbtn">
                                        <i class="fa fa-bell animated"></i>
                                        <small class="text-danger {!!($notif->count())?'':'hide'!!}">
                                            <i class="fa fa-exclamation-triangle {!!($notif->count())?'faa-vertical':''!!} animated"></i>
                                        </small>
                                    </a>
                                    <ul class="dropdown-content" id="member-notif">
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
                            @endguest
                            <li>
                                <a href="{{route('chart')}}"><i class="fa fa-shopping-cart"></i>
                                @if(Session::has('chart') && count(Session::get('chart')) > 0)
                                    <span>
                                        Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'))}}
                                    {{-- {{count(Session::get('chart'))}} --}}
                                    </span>
                                @else
                                @endif
                                </a>
                            </li>
                            <li><a href="{{route('member.wishlist')}}"><i class="fa fa-heart"></i></a></li>
                           
                            <li class="sidemenu-items"><a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="{{route('chart')}}">Keranjang</a></li>
                                    @guest
                                    @else
                                        <li><a href="{{route('checkout')}}">Checkout</a></li>
                                        <li><a href="{{route('member.wishlist')}}">Wishlist</a></li>
                                    @endguest
                                     <li><a href="{{route('product_admin_asdf')}}">Green Production</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/')}}">Home </a></li>
                             @guest
                                <li><a href="javascript:void(0)" onClick="showLoginModal()">login</a></li>
                                <li><a href="https://gicommunity.org/register">Register</a></li>
                            @else
                                <li class="sidemenu-items"><a href="javascript:void(0);">{{Auth::user()->name}} <i class="fa fa-angle-down"></i></a>
                            @endguest
                            @guest
                            @else
                            <ul>
                                @if(Auth::user()->is_admin())
                                    <li><a href="{{route('admin.config.profil')}}">Profil</a></li>
                                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                    @if(Auth::user()->seller_active() && Auth::user()->user_slug != null)
                                        <li><a href="{{route('etalase', Auth::user()->user_slug)}}">Etalase</a></li>
                                    @endif
                                @elseif(Auth::user()->is_member() )
                                    <li><a href="{{route('member.profil')}}">Profil</a></li>
                                    <li><a href="{{route('member.dashboard')}}">Dashboard</a></li>
                                    @if(Auth::user()->seller_active() && Auth::user()->user_slug != null)
                                        <li><a href="{{route('etalase', Auth::user()->user_slug)}}">Etalase</a></li>
                                    @endif
                                @endif
                                <li><a href="javascript(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            @endguest
                        </ul>
                </div>
                </div>
            </div>
        </div>
      
    </header>
    <!-- header-area end -->
    <!-- slider-area start -->
    <div style="padding: 0px" id="myModalLogin" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body"><br>
                    <div class="text-center">
            <div class="text-center">
            <a>
                <img class="dark-logo" src="https://gicommunity.org/images/gi_gw.png" alt="logo" width="60px" height="60px">
            </a>
            </div>
            </div>
                <br> 
                    <form action="#" id="formData" class="form-horizontal container col-md-12 col-md-offset-2" >
                         <span id="feedbackdata"></span>
                           @csrf
                           <div class="form-group">
                            <label for="username">username GI</label>
                              <input type="text" class="form-control m-input remove-border-focus" name="email" />
                              <span id="feedbackusername"></span>
                           </div>
                           <div class="form-group">
                             <label for="password">password GI</label>
                              <input class="form-control m-input remove-border-focus" type="password" name="password"/>
                              <span id="feedbackpassword"></span>
                           </div>
                           <div style="font-size: 12px">belum punya akun? <a href="https://gicommunity.org/register"> daftar </a></div>
                          <div class="pull-right" style="padding: 1.5rem 0;">
                            <a style="cursor: pointer; font-size: 14px; color: #fff" onclick="saveLogin()" class="btn btn-success btnsave">Masuk</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a style="cursor: pointer; font-size: 14px;" class="btn btn-metal" data-dismiss="modal">Tutup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showLoginModal(){
            $('.remove-border-focus').attr("style", "outline: 0px !important");
            $('.remove-border-focus').attr("style", "-webkit-appearance: none");
            $('.remove-border-focus').attr("style", "box-shadow: none !important");
            $('#myModalLogin').modal('show');
        }
        function saveLogin(){
            $('.btnsave').html("load...");
            $('.btnsave').addClass("disabled").prop('disabled', true);
            var dataString = $("#formData").serialize();
            $.ajax({
                url : "{{ url('/login_gi') }}",
                type: "POST",
                data: dataString,
                dataType: "JSON",
                success: function(data){
                 if(data.sucess){
                    location.reload();
                 }
                 (!data.error.email) ?
                 $("#feedbackusername").html('') : $("#feedbackusername").html('<span style="font-size: 12px; color: #ed5249">' + data.error.email[0] +'</span>');
                 (!data.error.password) ?
                 $("#feedbackpassword").html('') : $("#feedbackpassword").html('<span style="font-size: 12px; color: #ed5249">' + data.error.password[0] +'</span>');
                 (!data.error.data) ?
                 $("#feedbackdata").html('') : $("#feedbackdata").html('<div class="alert alert-danger text-center" role="alert">' + data.error.data +'</div>');
                 $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);

                },
                error: function (err){
                    console.log(err.error);
                    $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);
                }
            });
        }
    </script>