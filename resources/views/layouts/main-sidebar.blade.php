<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/admin/home') }}"><img src="{{URL::asset('images/app/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/admin/home')  }}"><img src="{{URL::asset('images/app/icon.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/admin/home') }}"><img src="{{URL::asset('images/app/icon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/admin/home')  }}"><img src="{{URL::asset('images/app/icon.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">

        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('images/app/me.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">

            {{-- The App main link --}}

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/admin/home' ) }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" /></svg><span class="side-menu__label">الرئيسية</a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route("front.index") }}"> <i class="side-menu__icon fa fa-sitemap " viewBox="0 0 24 24"></i> <span class="side-menu__label">صفحة الموقع الرئيسي</a>
            </li>

            {{-- Client and users Links  --}}
            @if(auth()->user()->can("show-client") || auth()->user()->can("show-user") || auth()->user()->can("show-role") )
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ route("client.index") }}">
                    <i class="side-menu__icon fa fa-users-cog" viewBox="0 0 24 24"></i>
                    <span class="side-menu__label"> توزيعات المستخدمين</span><i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    @if(auth()->user()->can("show-user"))
                    <li>
                        <a href="{{ route("user.index") }}" class="slide-item">
                            <i class="nav-icon fas fa-crown ml-2 "></i>
                            المستخدمين
                        </a>
                    <li>
                        @endif

                        @if(auth()->user()->can("show-role"))
                    <li>
                        <a href="{{ route("role.index") }}" class="slide-item">
                            <i class=" nav-icon fas fa-exchange-alt ml-2 "></i>
                            رتب المستخدمين
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can("show-client"))
                    <li>
                        <a href=" {{ route("client.index") }}" class="slide-item ">
                            <i class="nav-icon fas fa-users ml-2"></i>
                            العملاء
                        </a>
                    </li>
                    @endif
                </ul>


            </li>

            @endif


        {{-- The contianers of articles , categoreis and donaiton requests  --}}
        @if (auth()->user()->can("show-donation-request") || auth()->user()->can("show-category") ||auth()->user()->can("show-post"))
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/post' ) }}"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24">
                    <g>
                        <rect fill="none" />
                    </g>
                    <g>
                        <g />
                        <g>
                            <path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z" />
                            <path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3" />
                        </g>
                        <g>
                            <path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z" />
                            <path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z" />
                            <path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z" />
                        </g>
                    </g>
                </svg><span class="side-menu__label">المحتويات</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @if(auth()->user()->can("show-category"))
                <li>
                    <a href="{{ route("category.index") }}" class="slide-item">
                        <i class="nav-icon fas fa-newspaper  ml-2"></i>
                        الاقسام
                    </a>
                </li>
                @endif
                @if(auth()->user()->can("show-post"))
                <li>
                    <a href="{{ route("post.index") }}" class="slide-item">
                        <i class="nav-icon fas fa-file-contract ml-2"></i>
                        المقالات
                    </a>
                </li>
                @endif
                @if(auth()->user()->can("show-donation-request"))
                <li>
                    <a href="{{ route("donation-request.index") }}" class="slide-item">
                        <i class="nav-icon fas fa-hand-holding-heart ml-2 "></i>
                        طلبات التبرع
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        {{-- Places  --}}
        @if ( auth()->user()->can("show-city") ||auth()->user()->can("show-governorate"))
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url("\governorate") }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity=".3" />
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z" />
                    <circle cx="12" cy="9" r="2.5" /></svg><span class="side-menu__label">الأماكن</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @if(auth()->user()->can("show-governorate"))
                <li>
                    <a href="{{ route("governorate.index") }}" class="slide-item">
                        <i class="nav-icon fas fa-list"></i>
                        المحافظات
                    </a>
                </li>
                @endif
                @if(auth()->user()->can("show-city"))
                <li>
                    <a href="{{ route("city.index") }}" class="slide-item">
                        <i class=" nav-icon fas fa-city ml-2"></i>
                        المدن
                    </a>
                </li>
                @endif

            </ul>
        </li>
        @endif

        {{-- Contact --}}
        @if (auth()->user()->can("show-contact"))
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url("/contact") }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3" />
                    <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z" /></svg><span class="side-menu__label"> الرسائل المستلمه</span><i class="angle fe fe-chevron-down"></i></a>

            <ul class="slide-menu">
                <li>
                    <a href="{{ route("contact.index") }}" class="slide-item">
                        <i class="nav-icon fas fa-spanhone ml-2"></i>
                        الرسائل المستلمه
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Setting of app --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/setting') }}">
                <i class="side-menu__icon fa fa-lock" viewBox="0 0 24 24"></i>
                <span class="side-menu__label">الأعدادت</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                @if(auth()->user()->can("show-setting"))

                <li>
                    <a href="{{ route("setting.edit") }}" class="slide-item">
                        <i class="nav-icon fas fa-cogs ml-2"></i>
                        أعدادت التطبيق
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route("password.edit-user",auth()->user()->id) }}" class="slide-item">
                        <i class="nav-icon fas fa-edit ml-2 "></i>
                        تعديل كملة المرور
                    </a>
                </li>
            </ul>
        </li>






    </div>



</aside>
<!-- main-sidebar -->
