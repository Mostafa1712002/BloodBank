@extends('front.layouts.master')
@section('content')

<!--intro-->
<div class="intro">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item carousel-1 active">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {{ $settings->intro_who_are_us }}
                        </p>
                        <a href="{{ route("who-are-us") }}">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--about-->
<div class="about">
    <div class="container">
        <div class="col-lg-6 text-center">
            <p>
                <span>بنك الدم</span> {{ $settings->intro }} </p>
        </div>
    </div>
</div>

<!--articles-->
<div class="articles">
    <div class="container title">
        <div class="head-text">
            <h2>المقالات</h2>
        </div>
    </div>
    <div class="view">
        <div class="container">

            @if (count($posts))

            <div class="row">
                <!-- Set up your HTML -->
                <div class="owl-carousel articles-carousel">
                    @foreach($posts as $post)
                    <div class="card">
                        <div class="photo">
                            <img src={{ asset("$post->image") }} class="card-img-top" alt="...">
                            <a href="{{ url("front/inside-post/$post->id") }}" class="click">المزيد</a>
                        </div>
                        @if (auth("front")->user())
                        <i class="favourite" data-post-id="{{ $post->id }}" style="cursor: pointer ">
                            <i class="far fa-heart {{ $post->is_favorite_front? "with-heart" : "without-heart" ;   }}"></i>
                        </i>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"> {{ $post->title }}</h5>
                            <p class="card-text">
                                {{ $post->content }}
                            </p>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
            @else
            <div class="alert alert-danger d-block text-center row">
                لاتوجد مقالات بعد...............
            </div>
            @endif
        </div>
    </div>
</div>


<div class="requests">
    <div class="container">
        <div class="head-text">
            <h2>طلبات التبرع</h2>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="patients">
                @forelse ($donationRequests as $donationRequest)


                <div class="details">
                    <div class="blood-type">
                        <h2 dir="ltr">B+</h2>
                    </div>
                    <ul>
                        <li><span>اسم الحالة:</span> {{ $donationRequest->patient_name }}</li>
                        <li><span>مستشفى:</span>{{ $donationRequest->hospital_name }}</li>
                        <li><span>المدينة:</span> {{ $donationRequest->city->name }}</li>
                    </ul>
                    <a href="{{ route("client-donation-request.show",$donationRequest->id) }}">التفاصيل</a>
                </div>
                @empty
                <div class="text-center alert alert-danger">
                    لا توجد طلابات تبرع بعد
                </div>
                @endforelse
            </div>
            <div class="more">
                <a href="{{ route("client-donation-request.index") }}">المزيد</a>
            </div>
        </div>
    </div>
</div>

<!--contact-->
<div class="contact">
    <div class="container">
        <div class="col-md-7">
            <div class="title">
                <h3>اتصل بنا</h3>
            </div>
            <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
            <div class="row whatsapp">
                <a href="{{ $settings->whats_app }}" target="_blank">
                    <img src={{ asset("front/imgs/whats.png") }}>
                    <p dir="ltr">{{ $settings->phone_number }}</p>
                </a>
            </div>
        </div>
    </div>
</div>
<!--app-->
<div class="app">
    <div class="container">
        <div class="row">
            <div class="info col-md-6">
                <h3>تطبيق بنك الدم</h3>
                <p>
                    {{ $settings->intro_app_phone }}
                </p>
                <div class="download">
                    <h4>متوفر على</h4>
                    <div class="row stores">
                        <div class="col-sm-6">
                            <a href="{{ $settings->google_play_link }}">
                                <img src={{ asset("front/imgs/google.png") }}>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ $settings->app_store_link }}">
                                <img src={{ asset("front/imgs/ios.png") }}>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screens col-md-6">
                <img src={{ asset("front/imgs/App.png") }}>
            </div>
        </div>
    </div>
</div>
@endsection
