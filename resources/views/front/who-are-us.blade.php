@extends('front.layouts.master')
@section('content')
<body class="who-are-us">
    <!--inside-article-->
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active " aria-current="page">من نحن</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo">
                    <img src={{ asset("front/imgs/logo.png") }}>
                </div>
                <div class="text">
                    <p>
                        {{ $settings->who_are_us }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endsection
