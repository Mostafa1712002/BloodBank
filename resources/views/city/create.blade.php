
    @extends('layouts.master')
    @section('css')
    <!--  Custom same page css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    @endsection
    @section('main-word')
    الأماكن
    @endsection
    @section("page-header")
    {{-- Page headerr  --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">إنشاء مدينه جديده</h2>
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
                {!! Form::open([
                    "action" => "App\Http\Controllers\cityController@store"

                    ]) !!}
                    {!! Form::label("city_name","أسم المدينه") !!}
                    {!! Form::text('name',null,[
                    "class" => "form-control",
                    "id"=> "city_name",
                    "placeholder" => "أدخل اسم المدينه"
                    ]) !!}
                    {!! Form::label("governorate_name","أختر اسم المحافظه  ",["class"=>" mt-2"]) !!}

                    {!!
                    Form::select(
                    'governorate_id',
                    $records,
                    null,
                    ["class"=> "form-control" , "id" => "governorate_name" ])
                    !!}
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
