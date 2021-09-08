@extends('layouts.master')
@section('main-word')
    الأعدادت
@endsection
@section('title')
    الأعدادت - بنك الدم
@endsection
{{-- Page headerr --}}
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">أعدادت التطبيق</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- card -->
            <div class="card">
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                    @include('flash::message')

                    {!! Form::model($record, [
    'method' => 'post',
    'action' => 'App\Http\Controllers\settingController@update',
]) !!}
                    <div class="form-group">
                        {!! Form::label('notification_text', 'نص الأشعارات ') !!}
                        {!! Form::textarea('notification_settings_text', null, [
    'class' => 'form-control',
    'id' => 'نص الاشعارات',
    'placeholder' => 'تعديل نص الأشعارات ',
]) !!}
                    </div>
                    {!! Form::text('id', null, ['hidden']) !!}



                    <div class="form-group">
                        {!! Form::label('intro', 'مقدمه عن التطبيق') !!}
                        {!! Form::textarea('intro', null, [
    'class' => 'form-control',
    'id' => 'intro',
    'placeholder' => 'تعديل مقدمه عن التطبيق ',
]) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('about_app', 'عن التطبيق') !!}
                        {!! Form::textarea('about_app', null, [
    'class' => 'form-control',
    'id' => 'about_app',
    'placeholder' => 'تعديل نص عن التطبيق ',
]) !!}
                    </div>




                    <div class="form-group">
                        {!! Form::label('intro', 'مقدمه عن من نحن') !!}
                        {!! Form::textarea('intro_who_are_us', null, [
    'class' => 'form-control',
    'id' => 'intro_who_are_us',
    'placeholder' => 'تعديل مقدمه عن من نحن ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('who_are_us', 'من نحن ') !!}
                        {!! Form::textarea('who_are_us', null, [
    'class' => 'form-control',
    'id' => 'who_are_us',
    'placeholder' => 'تعديل نص من نحن ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('intro_app_phone', 'نص مقدمة للحصول علي التطبيق من الهاتف') !!}
                        {!! Form::textarea('intro_app_phone', null, [
    'class' => 'form-control',
    'id' => 'intro_app_phone',
    'placeholder' => 'تعديل نص للحصول نحن علي التطبيق من الهاتف ',
]) !!}
                    </div>




                    <div class="form-group">
                        {!! Form::label('app_store_link', ' لينك آبل آستور') !!}
                        {!! Form::text('app_store_link', null, [
    'class' => 'form-control',
    'id' => 'app_store_link',
    'placeholder' => 'تعديل لينك آبل آستور ',
]) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('google_play_link', ' لينك جوجل بلاي') !!}
                        {!! Form::text('google_play_link', null, [
    'class' => 'form-control',
    'id' => 'google_play_link',
    'placeholder' => 'تعديل لينك جوجل بلاي ',
]) !!}
                    </div>
                    <div class="form-group">

                        {!! Form::label('whats_app', ' لينك الواتس آب') !!}
                        {!! Form::text('whats_app', null, [
    'class' => 'form-control',
    'id' => 'whats_app',
    'placeholder' => 'تعديل لينك الواتس آب ',
]) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('fb_link', ' لينك الفيس بوك') !!}
                        {!! Form::text('fb_link', null, [
    'class' => 'form-control',
    'id' => 'fb_link',
    'placeholder' => 'تعديل لينك الفيس بوك ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('tw_link', 'لينك التويتر') !!}
                        {!! Form::text('tw_link', null, [
    'class' => 'form-control',
    'id' => 'tw_link',
    'placeholder' => 'تعديل لينك Twitter ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('insta_link', 'لينك الأنستجرام') !!}
                        {!! Form::text('insta_link', null, [
    'class' => 'form-control',
    'id' => 'insta_link',
    'placeholder' => 'تعديل لينك الأنستجرام ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone_number', 'رقم الهاتف') !!}
                        {!! Form::text('phone_number', null, [
    'class' => 'form-control',
    'id' => 'phone_number',
    'placeholder' => 'رقم الهاتف',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fax', ' فاكس') !!}
                        {!! Form::text('fax', null, [
    'class' => 'form-control',
    'id' => 'fax',
    'placeholder' => ' فاكس',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', ' البريد الالكتروني') !!}
                        {!! Form::email('email', null, [
    'class' => 'form-control',
    'id' => 'email',
    'placeholder' => ' البريدالالكتروني',
]) !!}
                    </div>


                    <div class="form-group">
                        <button class="btn btn-info  btn-md mr-2"> تعديل</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
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
