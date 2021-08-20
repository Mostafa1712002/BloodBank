@extends('front.layouts.master')
@section('content')
@inject('bloodTypes', 'App\Models\BloodType')
@inject('governorates', 'App\Models\Governorate')

<body class="create">
    <!--form-->

    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                @include('flash::message')
                <form action="{{ route("client.register-save") }}">
                    @if (Route::current()->getName() == "login.handle")
                    <input hidden value="{{ $valid }}" id="valid">
                    @endif
                    <div class="form-group">
                        <label for="name"> ادخل الاسم بالكامل</label>
                        <input id="name" type="text" name="name" value="{{ old("name") }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email"> ادخل البريد الالكتروني </label>
                        <input id="email" type="email" name="email" value='{{ old("email") }}' class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="d_o_b">تاريخ الميلاد</label>
                        <input id="d_o_b" class="form-control @error('d_o_b') is-invalid @enderror" name="d_o_b" value="{{ date(old('d_o_b')) }}" type="date">
                        @error('d_o_b')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="blood_type_id"> ادخل فصيلة الدم</label>
                        <select name="blood_type_id" id="blood_type_id" class="form-control @error('blood_type_id') is-invalid @enderror">
                            <option selected disabled hidden value="">فصيلة الدم</option>
                            @foreach ($bloodTypes::all() as $bloodType)
                            <option value="{{ $bloodType->id }}"> {{ $bloodType->name }}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('blood_type_id')
                            <span class="invalid-feedback  d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="governorates">ادخل المحافظة</label>
                        <select class="form-control  @error('governorate_id') is-invalid @enderror " id='governorates' name='governorate_id'>
                            <option selected disabled hidden value="">المحافظة</option>
                            @foreach ($governorates::all() as $governorate)
                            <option value=" {{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cities"> ادخل المدينة</label>
                        <select class="form-control  @error('city_id') is-invalid @enderror" id="cities" name="city_id">
                            <option selected disabled hidden value="">المدينة</option>
                        </select>
                        @error('city_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">ادخل رقم الهاتف</label>
                        <input type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{ old("phone") }}" placeholder="رقم الهاتف">
                        @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_donation_date">آخر تاريخ تبرع</label>
                        <input name="last_donation_date" class="form-control @error('last_donation_date') is-invalid @enderror " value=" {{ date(old('last_donation_date')) }}" type="date" id="last_donation_date">
                        @error('last_donation_date')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">ادخل الرقم السري</label>
                        <input type="password" id="password" name="password" class="form-control  @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">تأكيد الرقم السري</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control  @error('password') is-invalid @enderror " placeholder="">
                    </div>

                    <div class=" create-btn">
                        <input type="submit" value="إنشاء">
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    @endsection
    @push('front-js')

    <script>
        $(function() {

            $("#governorates").change(function() {

                var governorateId = $("#governorates").val();

                if (governorateId) {

                    $("#cities").empty();
                    $("#cities").append('<option selected disabled hidden value="">المدينة</option>');
                    $.ajax({
                        url: '{{ url("api/v1/cities?governorate_id=") }}' + governorateId
                        , success: function(data) {

                            if (data.status == 1) {

                                $.each(data.data, function(index, cities) {
                                    cities.forEach(city => {

                                        $("#cities").append('<option value=" ' + city.id + '">' + city.name + '</option>');
                                    });
                                });
                            }
                        }
                    });
                } else {
                    $("#cities").append('<option selected disabled hidden value="">المدينة</option>');

                }
            });
            var $valid = $("#valid").val();
            if ($valid == 1) {
                Swal.fire({
                    title: '<h3>  نأسف لا يمكنك مواصلة تصفح بنك الدم </h3>'
                    , icon: 'info'
                    , html: '<b> لا يمكنك الدخول الصفحه لانك لم تسجل الدخول <br> <br>' +
                        ' <div class="row m-0">' +
                        ' <div class="col-6">' +
                        '<a href="{{ route("sign-in-account") }}" class=" btn-md btn btn-success"> تسجيل الدخول<a>' +
                        '  </div>' +
                        '   <div class="col-6">' +
                        '    <a href="{{ route("create-account") }}" class=" btn-md btn btn-secondary"> إنشاء حساب جديد<a>' +
                        '      </div>' +
                        ' </div>'
                    , showCancelButton: false
                    , showConfirmButton: false

                })



            }


        })

    </script>
    @endpush
