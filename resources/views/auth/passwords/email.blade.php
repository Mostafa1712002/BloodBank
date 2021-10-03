@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('title')
    استعادة كلمة المرور - بنك الدم
@endsection
@section('content')
<div class="container-fluid pl-0">
    <div class="row no-gutter">
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
            <div class="login d-flex align-items-center py-2">
                <!-- Demo content-->
                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="mb-5 d-flex"> <a href="{{ url('/home') }}"><img src="{{URL::asset('images/app/logo.png')}}" class="sign-favicon ht-40" alt="logo"></a>
                                <h1 class="main-logo1 ml-1 mr-3 my-auto tx-28">تطبيق <span> بنك</span> الدم</h1>
                            </div>
                            <div class="main-card-signin d-md-flex bg-white">
                                <div class="wd-100p">
                                    <div class="main-signin-header">
                                        <h2>نسيت كملة المرور </h2>
                                        <h4>من فضلك أدخل البريد الالكتروني</h4>
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group text-right">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني </label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">
                                                أرسل رابط التحقق
                                            </button>
                                        </form>
                                    </div>
                                    <div class="main-signup-footer mg-t-20">
                                        <p>لقد نسيت <a href="{{ route("sign-in-account") }}"> أرجعني </a>لتسجيل الدخول </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->

        <!-- The image half -->
        <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
            <div class="row wd-100p mx-auto text-center">
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p"> <img src={{ asset("images/app/forgot.png") }} class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo"> </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
