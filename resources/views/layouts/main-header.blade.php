<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">

        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/home' ) }}"><img src="{{URL::asset('images/app/logo.png')}}" class="logo-1" alt="logo"></a>
                <a href="{{ url('/home' ) }}"><img src="{{URL::asset('images/app/logo.png')}}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/home' ) }}"><img src="{{URL::asset('images/app/logo.png')}}" class="logo-2" alt="logo"></a>
                <a href="{{ url('/home' ) }}"><img src="{{URL::asset('images/app/logo.png')}}" class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>


            <div class="mr-2">
                <b style="font-size: 29px">@yield("main-word")</b>
            </div>

        </div>

        <div class="mian-header-rigth">
            <div class="nav nav-item  ">
                <li class="nav-item  nav-bar dropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                        <i class="fas fa-sign-out-alt ml-1"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </div>
        </div>


    </div>
</div>
<!-- /main-header -->
