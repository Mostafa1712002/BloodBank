@extends('layouts.master')
@section('main-word')
الرئيسية
@endsection
@section('page-header')
<h3 class="mt-3 mb-3">
    معلومات الموقع
</h3>
@endsection
@inject('clients', 'App\Models\Client')
@inject('users', 'App\Models\User')
@inject('bloodTypes', 'App\Models\BloodType')
@inject('categories', 'App\Models\Category')
@inject('cities', 'App\Models\City')
@inject('contacts', 'App\Models\Contact')
@inject('donationRequests', 'App\Models\DonationRequest')
@inject('governorates', 'App\Models\Governorate')
@inject('posts', 'App\Models\Post')
@section('title')
    الصفحه الرئيسيه - بنك الدم
@endsection
@section('content')



@if (auth()->user()->can("show-role"))
<div class="row">
    <div class="col-12 text-body text-center " style=" font-size:50px">

        <a href="{{ route("user.index") }}" class="text-secondary"> عن المستخدمين
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
        <div class="card bg-danger-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-users-cog tx-60"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white  " style="font-size: 40px">عدد المستخدمين</span>
                            <h2 class="text-white mb-0">{{ count($users::pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<hr>
@endif



@if (auth()->user()->can("show-client"))
<div class="row">
    <div class="col-12 text-body text-center " style=" font-size:50px">

        <a href="{{ route("client.index") }}" class="text-secondary"> عن العملاء
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-4 col-xl-4 col-md-4 col-12">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fe fe-users tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white  " style="font-size: 25px">عدد العملاء</span>
                            <h2 class="text-white mb-0">{{ count($clients::pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-xl-4 col-md-4 col-12">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="far fa-arrow-alt-circle-up tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white" style="font-size: 25px"> المفعلين</span>
                            <h2 class="text-white mb-0">{{ count($clients::where("is_active",1)->pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-4 col-md-4 col-12">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center">
                            <i class="far fa-arrow-alt-circle-down tx-40"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white" style="font-size: 25px">غير المفعلين</span>
                            <h2 class="text-white mb-0">{{ count($clients::where("is_active",0)->pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endif





@if (auth()->user()->can("show-category"))
<div class="row">
    <div class="col-12 text-body text-center " style=" font-size:50px">

        <a href="{{ route("category.index") }}" class="text-secondary"> عن الأقسام
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
        <div class="card bg-success-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-newspaper tx-60"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white  " style="font-size: 40px">عدد الأقسام</span>
                            <h2 class="text-white mb-0">{{ count($categories::pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endif


@if (auth()->user()->can("show-post"))
<div class="row">
    <div class="col-12 text-body text-center " >

        <a href="{{ route("user.index") }}" class="text-secondary">
            عن المقالات
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
        <div class="card bg-warning-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-file-contract tx-60 "></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white" style="font-size: 40px">عدد المقالات</span>
                            <h2 class="text-white mb-0">{{ count($posts::pluck("title")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endif


@if (auth()->user()->can("show-donation-request"))
<div class="row">
    <div class="col-12 text-body text-center " style=" font-size:50px">

        <a href="{{ route("donation-request.index") }}" class="text-secondary"> عن طلبات التبرع
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
        <div class="card bg-success-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fas fa-hand-holding-heart tx-60"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white  " style="font-size: 40px">عدد طلبات التبرع </span>
                            <h2 class="text-white mb-0">{{ count($users::pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<hr>
@endif



@if (auth()->user()->can("show-contact"))
<div class="row">
    <div class="col-12 text-body text-center " style=" font-size:50px">

        <a href="{{ route("contact.index") }}" class="text-secondary"> عن الرسائل المستلمه
        </a>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-12">
        <div class="card bg-info-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas  fa-mail-bulk tx-60"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white  " style="font-size: 40px">عدد الرسائل المستلمه </span>
                            <h2 class="text-white mb-0">{{ count($contacts::pluck("name")->toArray()) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
<hr>
@endif

<div class=" row fix-smooth">
</div>

</div>
</div>
@endsection
