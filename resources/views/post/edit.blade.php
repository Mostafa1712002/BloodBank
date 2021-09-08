@extends('layouts.master')
@section('main-word')
المحتويات
@endsection
@section('title')
    تعديل مقال - بنك الدم 
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">تعديل المقال</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <!-- .card -->
        @include('flash::message')
<div class="card">
    <div class="card-body">

        {!! Form::model($record,[
            "action" => ["App\Http\Controllers\postController@update",$record->id],
            "enctype" =>"multipart/form-data",
            "method" => "put"
            ]) !!}

            <div class="form-group">
                {!! Form::label("post_title","عنوان المقال") !!}
                {!! Form::text('title',null,[
                "class" => "form-control",
                "id"=> "post_title",
                "placeholder" => "تعديل عنوان المقال"
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("post_content","محتوي المقال ",null) !!}
                {!! Form::textarea('content',null,[
                "class" => "form-control",
                "id"=> "post_content",
                "placeholder" => "تعديل محتوي  المقال"
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("image","تعديل صورة المقال",null) !!}
                <img src="{{ asset("$record->image") }}" style=" width:4pc ; height:4pc;">
                <p class="btn btn-secondary edit-image btn-sm">  تعديل الصوره المقال</p>
                {!! Form::file("image", $attributes = [ "class" => "form-control mt-3 invisible" , "id"=> "file"]); !!}
            </div>

            <div class="form-group">
                {!! Form::label("governorate_name","تعديل اسم القسم",null) !!}
                {!!
                Form::select(
                'category_id',
                $categories,
                $record->category->id,
                ["class"=> "form-control" , "id" => "category_name" ])
                !!}
                <div class="form-group">
                <button class="btn btn-info mt-3" >حفظ</button>
            </div>
                {!! Form::close() !!}

    </div>
</div>
        <!-- /.card -->
    </div>
</div>
<!-- row close -->
{{-- Row for fix smooth --}}
<div class="row row-sm fix-smooth">

@endsection
@section('js')
<script>
    $(function() {
        // Button for upload edit yes or no .
        var $eidtbutton = ".edit-image";
        $($eidtbutton).on("click", function() {
            $(this).each(function() {
                $("#file").toggleClass("invisible");
                if ($($eidtbutton).text() == "عدم تعديل الصوره") {
                    $($eidtbutton).text("تعديل الصوره");
                } else {
                    $($eidtbutton).text("عدم تعديل الصوره");

                }
            });
        });


    })

</script>
@endsection
