@extends('layouts.master')
@section('main-word')
الأماكن
@endsection
@section('title')
    تعديل محافظه - بنك الدم 
@endsection
{{-- Page headerr  --}}
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">تعديل المحافظه </h2>
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
            <div class="card-body">

                @include('flash::message')
                {!! Form::model($record,[
                "action" => ["App\Http\Controllers\governorateController@update",$record->id],
                "method" => "put",
                ]) !!}
                <div class="form-group">
                    {!! Form::label("أسم المحافظه ") !!}
                    {!! Form::text('name',null,[
                    "class" => "form-control",
                    ]) !!}
                </div>
                <button class="btn btn-info mt-3 btn-md "> حفظ</button>
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