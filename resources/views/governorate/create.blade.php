@extends('layouts.master')
@section('main-word')
الأماكن
@endsection
@section('title')
    إنشاء محافظه - بنك الدم 
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">إنشاء محافظه جديده</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <!-- .card -->
        <div class="card">
        <!-- .card body  -->

            <div class="card-body">

                @include('flash::message')
                {!! Form::open(["action" => "App\Http\Controllers\governorateController@store"]) !!}
                <div class="form-group">
                    {!! Form::label("اسم المحافظه ") !!}
                    {!! Form::text('name',null,["class" => "form-control","placeholder" => "أدخال اسم المحافظه الجديده"
                    ]) !!}
                </div>
                <button class="btn btn-info mt-3 btn-md "> حفظ</button>
                {!! Form::close() !!}

            </div>
        <!-- /.card body  -->

        </div>
        <!-- /.card -->
    </div>
</div>
<!-- row close -->
{{-- Row for fix smooth --}}
<div class="row row-sm fix-smooth">
</div>


@endsection
