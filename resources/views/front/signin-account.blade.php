@extends('front.layouts.master')

@section('content')

<body class="signin-account">
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                @include('flash::message')
                <form action="{{ route("sign-in-check") }}">
                    <div class="logo">
                        <img src={{ asset("front/imgs/logo.png") }}>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old("phone") }}" class="form-control" name="phone" placeholder="الجوال">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="كلمة المرور">
                    </div>
                    <div class="row options">
                        <div class="col-md-6 remember">
                            <div class="form-group form-check">
                                <input type="checkbox" name="remeber_me" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot">
                            <img src={{ asset("front/imgs/complain.png") }}>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('client.password.request') }}">
                                نسيت كملة المرور
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row buttons form-group">
                        <div class="col-md-6 right">
                            <button>دخول</button>
                        </div>
                        <div class="col-md-6 left">
                            <a href="{{ route("create-account")}}">انشاء حساب جديد</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
