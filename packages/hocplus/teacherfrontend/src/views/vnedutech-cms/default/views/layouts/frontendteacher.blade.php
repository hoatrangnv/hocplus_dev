<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') | {{ (!empty($SETTING['title'])) ? $SETTING['title'] : 'HOCPLUS' }} @show</title>

    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/css/jquery.fancybox.min.css' }}"/>
    <link rel="stylesheet" href="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/css/main.min.css?time=' . time() }}"/>

    <!--page css-->
    @yield('header_styles')
    <!--end of page css-->
</head>

<body>

<div id="app">

    @include('HOCPLUS-TEACHERFRONTEND::includes._header_teacher')

    @yield('content')

    @include('HOCPLUS-FRONTEND::includes._footer')

    @include('HOCPLUS-TEACHERFRONTEND::includes._modal')

</div> <!-- / App -->

<!-- js -->

<script type="text/javascript">var resetToken = '{{ $resetToken }}';</script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/jquery-3.3.1.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/jquery.fancybox.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/slick.min.js' }}"></script>
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/jquery.multiselect.js' }}"></script>

@yield('footer_scripts')

<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/src/js/main.js?time=' . time() }}"></script>
{{-- <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/teacherfrontend/script/auth.js?time=' . time() }}"></script> --}}


{{-- <script>
    var isLogin = '{{ Session::get("isLogin") }}';
    var isLoginCheck = {{ $isLoginCheck }};
    if(isLoginCheck == 'false'){
        $('body').addClass('user-anage-active');
    }

    $(document).ready(function () {
        $('body').on('click','.btn-registration',function(e){
            if(isLoginCheck == 0){
                e.preventDefault();
                $('body').addClass('user-anage-active');
                return false;
            }
        });
    });
</script> --}}
</body>
</html>