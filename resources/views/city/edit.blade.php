@extends('layouts.master')
@section('css')
@section('main-word')
الأماكن
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">تعديل مدينه </h2>
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
                "action" => ["App\Http\Controllers\cityController@update",$record->id],
                "method" => "put",

                ]) !!}
                <div class="form-group">
                    {!! Form::label("أسم المدينه") !!}
                    {!! Form::text('name',null,["class" => "form-control",]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("governorate_name","أختر أسم المحافظه",["class"=>" mt-2"]) !!}
                    {!! Form::select('governorate_id', $governorates,$record->governorate->id, ["class"=> "form-control"
                    , "id"
                    => "governorate_name" ]) !!}
                </div>

                <button class="btn btn-info mt-3 btn-md "> حفظ</button>
                {!! Form::close() !!}

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- row close -->
{{-- Row for fix smooth --}}
<div class="row row-sm fix-smooth">
</div>

</div>
</div>
<!-- Container closed -->
@endsection