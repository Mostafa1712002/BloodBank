<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="بنك الدم هو تظبيق يقوم بساعدة من يتبرعون و من يحناجون الي التبرع">
    <meta name="Author" content="Eng/Mostafa Ebrahim Alsayed">
    <meta name="Keywords" content="bloodBank,blood bank,بنك الدم ,الدم" />
    @include('layouts.head')
</head>

<body class="main-body bg-primary-transparent">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ URL::asset('images/app/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    @yield('content')
    @include('layouts.footer-scripts')
</body>

</html>
