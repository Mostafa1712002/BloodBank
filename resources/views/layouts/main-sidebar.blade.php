<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll noPrint">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img
                src="{{ URL::asset('images/app/logo.png') }}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="___class_+?14___">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('images/app/me.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="side-item side-item-category">تطبيق بنك الدم</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/admin/home') }}">
                    <svg viewBox="0 0 24 24" width="24" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 ml-2 side-menu__icon ">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="side-menu__label">الرئيسية</span>
                </a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/') }}">
                    <i class="las la-cloud-upload-alt side-menu__icon" viewBox="0 0 24 24"></i>
                    <span class="side-menu__label">الموقع</span>
                </a>
            </li>

            @if (auth()->user()->can('show-user') ||
    auth()->user()->can('show-role'))
                <li class="side-item side-item-category">مسئولين التطبيق</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                        <i class="las la-users-cog side-menu__icon" viewBox="0 0 24 24"></i>
                        <span class="side-menu__label">مسئولين
                            التطبيق</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if (auth()->user()->can('show-user'))
                            <li><a class="slide-item"   
                                    href="{{ url('/' . ($page = 'admin/user')) }}">المستخدمين</a>
                            </li>
                        @endif
                        @if (auth()->user()->can('show-role'))
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/role')) }}">رتب
                                    المستخدمين</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif



            @if (auth()->user()->can('show-donation-request') ||
    auth()->user()->can('show-category') ||
    auth()->user()->can('show-post') ||
    auth()->user()->can('show-city') ||
    auth()->user()->can('show-governorate') ||
    auth()->user()->can('show-contact'))
                <li class="side-item side-item-category">مكونات التطبيق</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                        <i class="fe fe-book-open side-menu__icon" viewBox="0 0 24 24"> </i>
                        <span class="side-menu__label">مكونات
                            التطبيق</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if (auth()->user()->can('show-donation-request'))
                            <li><a class="slide-item"
                                    href="{{ url('/' . ($page = 'admin/donation-request')) }}">طلابات التبرع</a>
                            </li>
                        @endif
                        @if (auth()->user()->can('show-category'))

                            <li><a class="slide-item"
                                    href="{{ url('/' . ($page = 'admin/category')) }}">الأقسام</a>
                            </li>
                        @endif
                        @if (auth()->user()->can('show-post'))

                            <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/post')) }}">المقالات</a>
                            </li>
                        @endif
                        @if (auth()->user()->can('show-contact'))
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/contact')) }}">الرسائل
                                    المستلمه</a>
                        @endif
                        @if (auth()->user()->can('show-governorate'))

                            <li><a class="slide-item"
                                    href="{{ url('/' . ($page = 'admin/governorate')) }}">المحافظات</a></li>
                        @endif
                        @if (auth()->user()->can('show-city'))

                            <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/city')) }}">المدن</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if (auth()->user()->can('show-client'))
                <li class="side-item side-item-category">أعضاء التطبيق</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">

                        <i class="las la-users side-menu__icon" viewBox="0 0 24 24"></i>
                        <span class="side-menu__label">أعضاء
                            التطبيق</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/client')) }}">العملاء</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('show-setting'))

                <li class="side-item side-item-category"> الأعدادت</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                        <i class="las la-cogs side-menu__icon " viewBox="0 0 24 24"></i>
                        <span class="side-menu__label">
                            الأعدادت</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{ url('/' . ($page = 'admin/setting-edit')) }}">الأعدادت
                                العامه
                                لتطبيق</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
</aside>
<!-- main-sidebar -->

