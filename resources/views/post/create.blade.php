@extends('layouts.master')
@section('main-word')
المحتويات
@endsection
@section('title')
    إنشاء مقال - بنك الدم 
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">إنشاء مقال جديده</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        @include('flash::message')

        <!-- .card -->
        <div class="card">
            <div class="card-body">

                {!! Form::open([
                "action" => "App\Http\Controllers\postController@store",
                "enctype" =>"multipart/form-data",
                ]) !!}


                <div class="form-group">
                    {!! Form::label("post_title","عنوان المقال") !!}
                    {!! Form::text('title',null,[
                    "class" => "form-control",
                    "id"=> "post_title",
                    "placeholder" => "أدخل عنوان المقال"
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("post_content","محتوي المقال",["class"=> " mt-2"]) !!}
                    {!! Form::textarea('content',null,[
                    "class" => "form-control",
                    "id"=> "post_content",
                    "placeholder" => "أدخل محتوي المقال"
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("image","تحميل صورة المقال",["class"=>" mt-2"]) !!}
                    {!! Form::file("image", $attributes = [ "class" => "form-control" ]); !!}
                </div>

                <div class="form-group">
                    {!! Form::label("governorate_name","أختر القسم",["class"=>" mt-2"]) !!}
                    {!! Form::select('category_id',$records,null,["class"=> "form-control" , "id" => "category_name" ]) !!}
                </div>
                <button class="btn btn-info mt-3 btn-md ">حفظ </button>
                {!! Form::close() !!}

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- row close -->
</div>
</div>

{{-- Row for fix smooth --}}
<div class="row row-sm fix-smooth">
</div>


@endsection
