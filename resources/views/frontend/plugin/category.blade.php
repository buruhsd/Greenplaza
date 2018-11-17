<!-- <div class="col-lg-3 col-md-4 col-sm-6 col-10">
    <div class="cetagory-wrap">
        <span>All cetagory</span>
        <ul class="cetagory-items">
            <li><a href="#"><i class="fa fa-chain-broken"></i> List <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sub-cetagory">
                	<li>
			            <div class="row">
			        	@foreach($category as $item)
			            <div class="col-4">
			            	<a href="#"><i class="{{$item->category_icon}}"></i> {{$item->category_name}} <i class="fa fa-angle-right pull-right"></i></a>
			            </div>
			        	@endforeach
			            </div>
                	</li>
        		</ul>
            </li>
        </ul>
    </div>
</div> -->
<div class="col-lg-3 col-md-4 col-sm-6 col-10">
    <div class="cetagory-wrap">
        <span>All Category</span>
        <ul class="cetagory-items">
        	@foreach($category as $item)
        	<li>
            	<a href="{{url('category?cat='.$item->category_slug)}}"><i class="{{$item->category_icon}}"></i> {{$item->category_name}} <i class="fa fa-angle-right pull-right"></i></a>
            </li>
            @endforeach
            
            <div class="cetagory-bottom">
                <a href="#">All Category</a>
            </div>
        </ul>
    </div>
</div>
