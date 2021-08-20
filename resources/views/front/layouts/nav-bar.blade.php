<!--nav-->

<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="{{ route("front.index") }}">
                <img src={{ asset("front/imgs/logo.png") }} class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item  @if(Route::current()->getName() == 'front.index') active @endif ">
                        <a class=" nav-link" href="{{ route("front.index") }}">الرئيسية</a>
                    </li>

                    <li class="nav-item @if(Route::current()->getName() == 'about-blood-bank') active @endif ">
                        <a class=" nav-link" href="{{ route("about-blood-bank") }}">عن بنك الدم</a>
                    </li>

                    <li class="nav-item @if(Route::current()->getName() == 'article-details') active @endif ">
                        <a class=" nav-link" href="{{ route("article-details") }}">المقالات</a>
                    </li>

                    <li class="nav-item @if(Route::current()->getName() == 'client-donation-request.index') active @endif ">
                        <a class=" nav-link" href="{{ route("client-donation-request.index") }}">طلبات التبرع</a>
                    </li>
                    @if (auth("front")->user())

                    <li class="nav-item  @if(Route::current()->getName() == 'profile.edit') active @endif ">
                        <a class=" nav-link" href="{{route("profile.edit",0)   }}">تعديل حسابك</a>
                    </li>
                    @endif

                    <li class="nav-item  @if(Route::current()->getName() == 'who-are-us') active @endif ">
                        <a class=" nav-link" href="{{route("who-are-us")   }}">من نحن</a>
                    </li>

                    <li class="nav-item @if(Route::current()->getName() == 'contact-us') active @endif ">
                        <a class=" nav-link" href="{{ route("contact-us") }}">اتصل بنا</a>
                    </li>

                </ul>

                @if (auth("front")->user())
                <a href="{{ route("client-donation-request.create") }}" class="donate">
                    <img src={{ asset("front/imgs/transfusion.svg") }}>
                    <p>طلب تبرع</p>
                </a>
                @endif

            </div>

        </div>
    </nav>
</div>
