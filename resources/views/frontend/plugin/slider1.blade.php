
<div class="wave-list">
@foreach($category as $item)
    <a class="wave-items" href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a>
</div>
@endforeach