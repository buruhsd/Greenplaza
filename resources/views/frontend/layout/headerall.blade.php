    
<header class="header-area header-req">
   {{-- <div class="logo-responsive-initila-1 text-center">
      <a href="{{url("/")}}">
      <img width="100px" height="10px" src="{{ asset('assets/images/gi_logo.png') }}" alt="logo" >
      </a>
   </div> --}}
   <div class="header-bottom-area bg-1 header-bottom-area-two" style="padding: 0.8rem 0">
      <div class="container">
         <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
               <div class="logo-header-initila-1">
                  <a href="{{url("/")}}">
                  <img width="130px" height="40px" src="{{ asset('assets/images/gi_logo.png') }}" alt="" >
                  </a>
               </div>
               <form class="search-header-initila-1" action="{{route('category')}}" method="GET">
                  <div class="d-flex justify-content-between align-items-center">
                     <input name="cat" class="form-control" type="hidden" value="{{(isset($_GET['cat']))?$_GET['cat']:''}}">
                     <input name="src" class="form-control" type="text" placeholder="Produk" aria-label="produk" aria-describedby="basic-addon2" value="{{(isset($_GET['src']))?$_GET['src']:''}}">
                     <div class="input-group-append">
                        <button class="btn"><i class="fa fa-search"></i></button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="nav-menu-initila-1">
               <ul class="mainmenu d-flex align-items-center">
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
                        
                        {{-- <span>
                           MYR. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'))}}
                        </span> --}}
                        <span>
                           IDR. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_idr'))}}
                        </span>
                        
                     @else
                     @endif
                     </a>
                  </li>
                  <li><a href="{{route('member.wishlist')}}"><i class="fa fa-heart"></i></a></li>
                  @guest
                  <li><a href="javascript:void(0)" onClick="showLoginModal()">login</a></li>
                  <li><a href="https://gicommunity.org/register">Register</a></li>
                  @else
                  <li class="sidemenu-items">
                     <a href="javascript:void(0);">{{Auth::user()->name}} <i class="fa fa-angle-down"></i></a>
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
                        <li>
                           <a href="javascript(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </li>
                     </ul>
                     @endguest
                  <li></li>
                  <li class="sidemenu-items">
                     <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
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
               </ul>
            </div>
            <div class="responsive-menu-tigger d-block d-md-none">
               <a href="javascript:void(0);">
               <span class="first"></span>
               <span class="second"></span>
               <span class="third"></span>
               </a>
            </div>
         </div>
         <!-- responsive-menu area start -->
         <div class="responsive-menu-area d-block d-md-none">
            <div class="container">
               <div class="row">
                  <ul class="metismenu">
                     <li class="sidemenu-items">
                        <a href="javascript:void(0);">Kategori <i class="fa fa-angle-down"></i></a>
                        <ul class="cetagory-items">
                           <?php $cat = App\Models\Category::whereRaw('category_parent_id = 0')->limit(12)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->get();?>
                           @foreach($cat as $item)
                           <li>
                              <a href="{{route('category', ['cat'=>$item->category_slug])}}"><i class="fa fa-chain-broken"></i> {{ucfirst(strtolower($item->category_name))}} <i class="fa fa-angle-right pull-right"></i></a>
                              <?php $sub_cat = App\Models\Category::whereRaw('category_parent_id = '.$item->id)->limit(10)->get();?>
                              @if($sub_cat->count() > 0)
                              <ul class="sub-cetagory col-md-12 col-sm-12">
                                 <li>
                                    <p>{{ucfirst(strtolower($item->category_name))}}</p>
                                    <ul>
                                       @foreach($sub_cat as $item2)
                                       <li>
                                          <a href="{{route('category', ['cat'=>$item2->category_slug])}}">
                                          {{ucfirst(strtolower($item2->category_name))}}</a>
                                          <?php $sub_cat = App\Models\Category::whereRaw('category_parent_id = '.$item2->id)->limit(10)->get();?>
                                          @if($sub_cat->count() > 0)
                                          <ul class="sub-cetagory col-md-12 col-sm-12">
                                             <li>
                                                <p>{{ucfirst(strtolower($item2->category_name))}}</p>
                                                <ul>
                                                   @foreach($sub_cat as $item3)
                                                   <li><a href="{{route('category', ['cat'=>$item3->category_slug])}}">
                                                      {{ucfirst(strtolower($item3->category_name))}}</a>
                                                   </li>
                                                   @endforeach
                                                   <li><a href="{{route('category', ['cat'=>$item2->category_slug])}}">Lainya...</a>
                                                </ul>
                                             </li>
                                          </ul>
                                          @endif
                                       </li>
                                       @endforeach
                                       <li><a href="{{route('category', ['cat'=>$item->category_slug])}}">Lainya...</a>
                                    </ul>
                                 </li>
                              </ul>
                              @endif
                           </li>
                           @endforeach
                           <li><a href="{{route('category')}}"><i class="fa fa-chain-broken"></i> Semua Kategori... <i class="fa fa-angle-right pull-right"></i></a>
                        </ul>
                     </li>
                     <li class="sidemenu-items">
                        <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
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
                     @guest
                     <li><a href="javascript:void(0)" onClick="showLoginModal()">login</a></li>
                     <li><a href="https://gicommunity.org/register">Register</a></li>
                     @else
                     <li class="sidemenu-items">
                        <a href="javascript:void(0);">{{Auth::user()->name}} <i class="fa fa-angle-down"></i></a>
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
                           <li>
                              <a href="javascript(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
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
      <!-- responsive-menu area start -->
   </div>
</header>
    <!-- header-area end -->
    <!-- slider-area start -->
        <div style="padding: 0px" id="myModalLogin" class="modal fade" role="dialog">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <br>
            <div class="text-center">
               <div class="text-center">
                  <img class="dark-logo" src="{{ asset('frontend/images/logo-fix-2.png') }}" alt="" width="120px" height="40px">
               </div>
               <br>
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