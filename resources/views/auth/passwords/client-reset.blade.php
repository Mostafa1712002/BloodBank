@extends('layouts.master2')

@section('title')
    استعادة كلمة المرور - بنك الدم
@endsection

@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid pl-0">
    <div class="row">
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
            <div class="login d-flex align-items-center py-2">
                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin">
                                <div class="mb-5 d-flex"> <a href="{{ url('/home') }}"><img src="{{URL::asset('images/app/logo.png')}}" class="sign-favicon ht-40" alt="logo"></a>
                                    <h1 class="main-logo1  mr-2 my-auto tx-28">تطبيق <span> بنك</span> الدم</h1>
                                </div>
                            </div>
                            <div class="main-card-signin d-md-flex">
                                <div class="wd-100p">
                                    <div class="main-signin-header">
                                        <div class="">
                                            <h2>تعديل كملة المرور</h2>
                                            <input type="text" _mothod="PUT" hidden>
                                            <form action="{{ route("client.password.update") }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">
                                                <div class="form-group text-right">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني </label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder=" أدخل البريد الالكتروني " name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group text-right">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">كملة المرور </label>
                                                    <input id="password" type="password" placeholder=" ادخل كملة المرور" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group text-right">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كملة المرور</label>
                                                    <input id="password-confirm" placeholder=" اعد كتابة كملة  المرور" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>

                                                <button class="btn ripple btn-main-primary btn-block">اعادة تعين كملة المرور</button>
                                            </form>
                                        </div>
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
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p"> <img src={{ asset("images/app/reset.png") }} class="my-auto ht-xl-80p wd-md-100p wd-xl-50p ht-xl-60p mx-auto" alt="logo"> </div>
            </div>
        </div>
    </div>
</div>
@endsection
