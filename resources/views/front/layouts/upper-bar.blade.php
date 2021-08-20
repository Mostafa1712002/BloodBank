<!--upper-bar-->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="social">
                    <div class="icons">
                        <a target="_blank" href="{{ $settings->fb_link }}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="{{ $settings->insta_link }}" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="{{ $settings->tw_link }}" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="{{ $settings->whats_app }}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        @if ( auth("front")->user())
                        <a href="{{ route("profile.edit",0) }}" class="whatsapp">
                        <span class="ml-2"> {{ auth("front")->user()->name }}</span>
                            <i class="fas fa-user-cog"></i><a>
                                @endif

                                @if ( auth("web")->user())
                                <a href="{{ route("home.index") }}" class="twitter">
                                    <i class="fas fa-home"></i>
                                    لوحة التحكم
                                    <a>
                                @endif

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="accounts" dir="ltr">
                    @if (!auth("front")->user())
                    <a href="{{ route("sign-in-account") }}" class="signin">الدخول</a>
                    <a href="{{ route("create-account") }}" class="create-new">إنشاء حساب جديد</a>

                    @else
                    <a class="signin" href="{{ route('client-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                        <i class="fas fa-sign-out-alt ml-1"></i>
                    </a>
                    <form id="logout-form" action="{{ route('client-logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
