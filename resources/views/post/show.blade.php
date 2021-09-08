@extends('layouts.master')
@section('main-word')
    المحتويات
@endsection
@section('title')
    المقالات - بنك الدم
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> قائمة المقالات</h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card mb-3">
                <img src="{{ asset($post->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text"><small class="text-muted" style="direction: rtl"> تم التعديل في
                            {{ $post->updated_at }} </small></p>
                </div>
            </div>
        </div>
    </div>
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div class="row row-sm fix-smooth">
    </div>


@endsection
