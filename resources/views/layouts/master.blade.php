<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="بنك الدم هو تظبيق يقوم بساعدة من يتبرعون و من يحناجون الي التبرف">
    <meta name="Author" content="Eng/Mostafa Ebrahim Alsayed">
    <meta name="Keywords" content="bloodBank,blood bank,بنك الدم ,الدم" />
    @include('layouts.head')
</head>

<body class="main-body app sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{URL::asset('images/app/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @include('layouts.main-sidebar')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            {{-- @include('layouts.sidebar') --}}
            @include('layouts.footer-scripts')
            @include('layouts.footer')
</body>
</html>
