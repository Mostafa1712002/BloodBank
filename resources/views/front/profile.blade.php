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
                        <li class="breadcrumb-item active" aria-current="page">تعديل حسابك </li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                <div class=""text-center>
                    @include('flash::message')
                </div>
                {!! Form::open([
                "route" => ["profile.update", auth("front")->id()],
                "method" => "PUT"
                ]) !!}

                <div class="form-group">
                    <label for="name"> ادخل الاسم بالكامل</label>
                    <input id="name" type="text" name="name" value="{{ auth("front")->user()->name }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email"> ادخل البريد الالكتروني </label>
                    <input id="email" type="email" name="email" value="{{ auth("front")->user()->email }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="d_o_b">تاريخ الميلاد</label>
                    <input id="d_o_b" class="form-control @error('d_o_b') is-invalid @enderror" name="d_o_b" value="{{ date(auth("front")->user()->d_o_b) }}" type="date">
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
                        <option value="{{ $bloodType->id }}" @php if(auth("front")->user()->blood_type_id==$bloodType->id){ echo "selected" ;} @endphp> {{ $bloodType->name }} </option>
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
                        <option value=" {{ $governorate->id }}" @php if(auth("front")->user()->city->governorate_id==$governorate->id){ echo "selected" ;} @endphp > {{ $governorate->name }}</option>
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
                    <input type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{ auth("front")->user()->phone }}" placeholder="رقم الهاتف">
                    @error('phone')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_donation_date">آخر تاريخ تبرع</label>
                    <input name="last_donation_date" class="form-control @error('last_donation_date') is-invalid @enderror " value="{{ date( auth("front")->user()->last_donation_date) }}" type="date" id="last_donation_date">
                    @error('last_donation_date')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">ادخل الرقم السري</label>
                    <input type="password" id="password" name="password" placeholder="تعديل الرقم السري" class="form-control  @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد الرقم السري</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control  @error('password') is-invalid @enderror " placeholder=" تعديل تاكيد السري">
                </div>

                <div class=" create-btn">
                    <input type="submit" value="تعديل">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

    @endsection
    @push('front-js')

    <script>
        $(function() {
            // To get the data of city which client choice it .
            (function() {
                var governorateId = $("#governorates").val();
                var $city_id = '{{ auth() -> user() -> city_id }}';
                if (governorateId) {

                    $("#cities").empty();
                    $("#cities").append('<option selected disabled hidden value="">المدينة</option>');
                    $.ajax({
                        url: '{{ url("api/v1/cities?governorate_id=") }}' + governorateId
                        , success: function(data) {

                            if (data.status == 1) {

                                $.each(data.data, function(index, cities) {
                                    cities.forEach(city => {
                                        if (city.id == $city_id) {
                                            var selected = 'selected';
                                        } else {
                                            selected = "";
                                        }
                                        $("#cities").append('<option value=" ' + city.id + '" ' + selected + '  >' + city.name + '</option>');
                                    });
                                });
                            }
                        }
                    });
                } else {
                    $("#cities").append('<option selected disabled hidden value="">المدينة</option>');
                }
            })();

            //  to make dynaimce city with governorate
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



            $(".onefa").click(function(e) {
                e.preventDefault();
                $(".onefa > i ").toggleClass("fa-eye fa-eye-slash");
                var input = $(".one");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }

            });
            $(".twofa").click(function(e) {
                e.preventDefault();
                $(".twofa >  i ").toggleClass("fa-eye fa-eye-slash");
                var input = $(".two");

                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }

            });




        })

    </script>
    @endpush
