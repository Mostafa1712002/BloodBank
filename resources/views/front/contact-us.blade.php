@extends('front.layouts.master')

@section('content')

<body class="contact-us">
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="imgs/logo.png">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>الجوال:</span> {{ $settings->phone_number }}</li>
                                    <li><span>فاكس:</span> {{ $settings->fax }}</li>
                                    <li><span>البريد الإلكترونى:</span>{{ $settings->email }}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{ $settings->fb_link }}" target="_blank"><img src={{ asset("front/imgs/001-facebook.svg") }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->tw_link }}" target="_blank"><img src={{ asset("front/imgs/002-twitter.svg") }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->insta_link }}" target="_blank"><img src={{ asset("front/imgs/004-instagram.svg") }}></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{ $settings->whats_app }}" target="_blank"><img src={{ asset("front/imgs/005-whatsapp.svg") }}></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            {!! Form::open([
                            "route"=> "contact.store"
                            ]) !!}
                            @include('flash::message')

                            <input type="text" class="form-control" value="{{ old("name") }}" id="exampleFormControlInput1" placeholder="الإسم" name="name">
                            <input type="email" class="form-control" value="{{ old("email") }}" id="exampleFormControlInput1" placeholder="البريد الإلكترونى" name="email">
                            <input type="text" class="form-control" value="{{ old("phone") }}" id="exampleFormControlInput1" placeholder="الجوال" name="phone">
                            <input type="text" class="form-control" value="{{ old("subject") }}" id="exampleFormControlInput1" placeholder="عنوان الرسالة" name="subject">
                            <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3" name="message">{{ old("message") }}</textarea>
                            <button type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
