{{-- @extends('frontend.layout.index')
@section('title', 'Home')
@section('content')
@endsection --}}
<!doctype html>
<html class="no-js" lang="">
@include('frontend.fahmi-layout.header')

<body>
    @include('frontend.fahmi-layout.top-header')
    {{-- @include('frontend.plugin.slider-new') --}}
    @yield('content')
    {!! Plugin::footer()!!}
    @include('frontend.fahmi-layout.script')
    {!! (isset($footer_script))? $footer_script:'' !!}
</body>

</html>