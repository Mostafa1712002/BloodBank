@extends('layouts.master2')
@section('title')
الصفحه غير موجوده
@endsection
@section('content')
<!-- Main-error-wrapper -->
<div class="main-error-wrapper  page page-h ">
    <img src="{{URL::asset('images/app/404.png')}}" class="error-page" alt="error">
    <h2>لأسف الصفحه التي تحاول الوصول لها غير موجوده</h2>
    <h6>يمكن أنك قد أخطات في العنوان</h6><a class="btn btn-outline-danger" href="{{ url('/') }}">أرجع إلي الرئيسيه</a>
</div>
<!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection
