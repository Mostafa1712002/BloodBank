@extends('front.layouts.master')
@section('content')
<body class="donation-requests">
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>طلبات التبرع</h2>
                </div>
                <div class="content">
                    <form class="row filter">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="bloodType" class="form-control" id="exampleFormControlSelect1">
                                        <option selected disabled>اختر فصيلة الدم</option>
                                        @foreach ($bloodTypes as $bloodType)
                                        <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>

                                        @endforeach
                                    </select>

                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="city" class="form-control" id="exampleFormControlSelect1">
                                        <option selected disabled>اختر المدينة</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"> {{ $city->name }} </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">

                        @if (count($donationRequests))

                        @foreach ($donationRequests as $donationRequest)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{ $donationRequest->bloodType->name }}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span>{{ $donationRequest->patient_name }}</li>
                                <li><span>مستشفى:</span>{{ $donationRequest->patient_age }}</li>
                                <li><span>المدينة:</span> {{ $donationRequest->city->name }}</li>
                            </ul>
                            <a href="{{ route("client-donation-request.show",$donationRequest->id) }}">التفاصيل</a>
                        </div>
                        @endforeach

                        @else

                        <div class="alert alert-danger text-center text-bold">
                            <p>
                                لا توجد طلابات تبرع بعد
                            </p>
                        </div>
                        @endif

                    </div>

                    <div class="pages">
                        {{ $donationRequests->links("front.paginate") }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection
