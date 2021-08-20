@extends('front.layouts.master')

@section('content')
<body class="article-details">
    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $postChoice->title }} </li>
                    </ol>
                </nav>
            </div>
            <div class="article-image">
                <img src={{ asset($postChoice->image) }}>
            </div>
            <div class="article-title col-12">

                <div class="h-text col-6">
                    <h4>{{ $postChoice->title }}</h4>
                </div>
                <div class="icon favourite col-6" data-post-id="{{ $postChoice->id }}">
                    @if (auth("front")->user())
                    <button class="{{ $postChoice->is_favorite_front? "with-heart" : "without-heart" ;   }}" style="cursor: pointer">
                        <i class="far fa-heart without-heart"></i>
                    </button>
                    @endif

                </div>
            </div>

            <!--text-->
            <div class="text">
                {{ $postChoice->content }}
            </div>

            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>مقالات ذات صلة</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">

                            @foreach ($posts as $post)
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
                </div>
            </div>

        </div>
    </div>

    @endsection
