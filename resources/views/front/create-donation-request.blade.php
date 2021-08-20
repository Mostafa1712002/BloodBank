@extends('front.layouts.master')
@section('content')
@inject('bloodTypes', 'App\Models\BloodType')
@inject('governorates', 'App\Models\Governorate')
<body class="who-are-us">
    <!--inside-article-->
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إنشاء طلب تبرع</li>
                    </ol>
                </nav>
            </div>

            {!! Form::open([
            "route" => ["client-donation-request.store",0],
            ]) !!}
            @include('flash::message')
            <input type="text" value="{{ auth("front")->id() }}" name="client_id" hidden>
            <div class="form-group">
                <label for="patient_name">اسم المريض</label>
                {!! Form::text("patient_name",old("patient_name"), [
                "class"=> "form-control",
                "id" => "patient_name"
                ]) !!}
            </div>

            <div class="form-group">
                <label for="patient_age">عمر المريض</label>
                {!! Form::number("patient_age",old("patient_age"), [
                "class"=> "form-control",
                "id" => "patient_age"
                ]) !!}
            </div>

            <div class="form-group">
                <label for="patient_phone">رقم هاتف المريض</label>
                {!! Form::text("patient_phone",old("patient_phone"), [
                "class"=> "form-control",
                "id" => "patient_phone"
                ]) !!}
            </div>

            <div class="form-group">
                <label for="bags_num">عدد الاكياس</label>
                {!! Form::number("bags_num",old("bags_num"), [
                "class"=> "form-control",
                "id" => "bags_num"
                ]) !!}
            </div>

            <div class="form-group">
                <label for="blood_type_id"> ادخل فصيلة الدم</label>
                {!! Form::select("blood_type_id",$bloodTypes::pluck("name","id")->toArray(),auth("front")->user()->bloodType->id, [
                "class" => "form-control",
                "name" => "blood_type_id",
                "id" => "blood_type_id",
                "value" => old("blood_type_id")
                ]) !!}
            </div>
            <div class="form-group">
                <label for="governorates">ادخل المحافظة</label>
                <select class="form-control  @error(" governorate_id") is-invalid @enderror " id='governorates' name='governorate_id'>
                        <option selected disabled hidden value="">المحافظة</option>
                        @foreach ($governorates::all() as $governorate)
                        <option value=" {{ $governorate->id }}">{{ $governorate->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cities"> ادخل المدينة</label>
                <select class="form-control  @error(" city_id") is-invalid @enderror" id="cities" name="city_id">
                    <option selected disabled hidden >المدينة</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hospital_name">اسم المستشفي</label>
                {!! Form::text("hospital_name",old("hospital_name"), [
                "class"=> "form-control",
                "id" => "hospital_name"
                ]) !!}
            </div>


            <div class="form-group mb-5">
                <label for="map"> عنوان المستشفي</label>
                <input type="text" name="hospital_address" class="form-control" id="pac-input">
                <br>
            </div>
            {{-- Map billing waitted it :( --}}
            <div id="map" style="width:1110px; height:500px "></div>
            <input type="text" name="latitude" hidden id="latitude">
            <input type="text" name="longitude" hidden id="longitude">
<br>
            <div class="form-group">
                <label for="notes">ملاحظات</label>
                {!! Form::textarea("notes",old("notes"), [
                "class"=> "form-control",
                "id" => "notes"
                ]) !!}
            </div>


            {!! Form::submit("إرسال طلت تبرع", [
            "class"=> "btn btn-md btn-success"
            ]) !!}
            {!! Form::close() !!}
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
        });

    </script>

    <script>
        $("#pac-input").focusin(function() {
            $(this).val('');
        });
        $('#latitude').val('');
        $('#longitude').val('');
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 24.740691
                    , lng: 46.6528521
                }
                , zoom: 13
                , mapTypeId: 'roadmap'
            });
            // move pin and current location
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude
                        , lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(pos)
                        , map: map
                        , title: 'موقعك الحالي'
                    });
                    markers.push(marker);
                    marker.addListener('click', function() {
                        geocodeLatLng(geocoder, map, infoWindow, marker);
                    });
                    // to get current position address on load
                    google.maps.event.trigger(marker, 'click');
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                // console.log('dsdsdsdsddsd');
                handleLocationError(true, infoWindow, map.getCenter());
            }
            var geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function(event) {
                SelectedLatLng = event.latLng;
                geocoder.geocode({
                    'latLng': event.latLng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            deleteMarkers();
                            addMarkerRunTime(event.latLng);
                            SelectedLocation = results[0].formatted_address;
                            console.log(results[0].formatted_address);
                            splitLatLng(String(event.latLng));
                            $("#pac-input").val(results[0].formatted_address);
                        }
                    }
                });
            });

            function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
                var latlng = {
                    lat: markerCurrent.position.lat()
                    , lng: markerCurrent.position.lng()
                };
                // /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                $('#latitude').val(markerCurrent.position.lat());
                $('#longitude').val(markerCurrent.position.lng());
                geocoder.geocode({
                    'location': latlng
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(8);
                            var marker = new google.maps.Marker({
                                position: latlng
                                , map: map
                            });
                            markers.push(marker);
                            infowindow.setContent(results[0].formatted_address);
                            SelectedLocation = results[0].formatted_address;
                            $("#pac-input").val(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
                SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
            }

            function addMarkerRunTime(location) {
                var marker = new google.maps.Marker({
                    position: location
                    , map: map
                });
                markers.push(marker);
            }

            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            function clearMarkers() {
                setMapOnAll(null);
            }

            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            $("#pac-input").val("أبحث هنا ");
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon
                        , size: new google.maps.Size(100, 100)
                        , origin: new google.maps.Point(0, 0)
                        , anchor: new google.maps.Point(17, 34)
                        , scaledSize: new google.maps.Size(25, 25)
                    };
                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map
                        , icon: icon
                        , title: place.name
                        , position: place.geometry.location
                    }));
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        function splitLatLng(latLng) {
            var newString = latLng.substring(0, latLng.length - 1);
            var newString2 = newString.substring(1);
            var trainindIdArray = newString2.split(',');
            var lat = trainindIdArray[0];
            var Lng = trainindIdArray[1];
            $("#latitude").val(lat);
            $("#longitude").val(Lng);

        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC94vOBAInz0c1bF4MfnXSjEozpkaS9OKE&libraries=places&callback=initAutocomplete&language=ar&region=EG async defer"></script>
    {{-- This script just for testing remove it in real  --}}
    <script>
        $(function() {
            //  put defalut value for testing , And after i make api real restrict will remove and the code will work fun  .
            (function() {
                $("#latitude").val(24.740691);
                $("#longitude").val(46.6528521);
            })()
        })

    </script>
    @endpush
