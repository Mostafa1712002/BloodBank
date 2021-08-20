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
                        <li class="breadcrumb-item" aria-current="page">المقالات</li>
                    </ol>
                </nav>
            </div>

            <!--articles-->
            <div class="articles pos-relative">
                <div class="title">
                    <div class="head-text">
                        <h2>مقالات </h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @if (count($posts))
                            @foreach ($posts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src={{ asset("$post->image") }} class="card-img-top" alt="...">
                                    <a href="{{ url("front/inside-post/$post->id") }}" class="click">المزيد</a>
                                </div>
                                @if (auth("front")->user())

                                <i class="favourite" data-post-id="{{ $post->id }}" style="cursor: pointer">
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
                            @else
                            <div class="alert alert-danger text-centet" role="alert">
                                <strong>لا توجد مقالات لعرضها بعد</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="pages pos-absolute mt-2">
                {{ $posts->links("front.paginate") }}
            </div>
        </div>
    </div>

    @endsection
