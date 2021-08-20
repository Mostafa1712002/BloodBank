@extends('layouts.master')
@section('main-word')
توزيعات المستخدمين
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> إنشاء رتبة مستخدم </h2>
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
                "action" => "App\Http\Controllers\\roleController@store"
                ]) !!}
               @include("role.form")
                <div class="form-group">
                    <button class="btn btn-info mt-3 mr-2 btn-md "> حفظ</button>
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
</div>

</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<script>
    $("#select-all").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $("input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
            $("#select-all").prop("checked", false);
        }
    });

</script>
@endsection
