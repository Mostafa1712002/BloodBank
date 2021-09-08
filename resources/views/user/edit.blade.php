@extends('layouts.master')
@section('main-word')
    توزيعات المستخدمين
@endsection

@section('title')
    تعديل مستخدم - بنك الدم
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> تعديل مستخدم </h2>
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
                @include('flash::message')

                <div class="card-body">
                    {!! Form::model($record, ['route' => ['user.update', $record->id], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('اسم المستخدم ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'تعديل اسم المستخدم']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('البريد الألكتروني ') !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'تعديل البريد الألكتروني']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('كلمة المرور ') !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'تعديل كلمة المرور']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('تعديل تأكيد كلمة المرور ') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'تعديل تأكيد كلمة المرور']) !!}
                    </div>

                    <div class="form-group overflow-hidden">
                        {!! Form::label('أختر رتب المستخدم') !!}

                        {!! Form::select('listRoles[]', $listRoles, null, ['multiple', 'class' => 'form-control listRoles']) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-info mt-3 mr-2 btn-md "> حفظ</button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div class="row row-sm fix-smooth">
    </div>


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
