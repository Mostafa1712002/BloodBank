@extends('front.layouts.master')
@section('content')

<body class="inside-request">
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("front.index") }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="donation-requests.html">طلبات التبرع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلب التبرع: احمد محمد</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="person">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>الإسم</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donationRequest->patient_name }} </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>فصيلة الدم</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ $donationRequest->bloodType->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>العمر</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donationRequest->patient_age }} </p>
                                        عام
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>عدد الأكياس المطلوبة</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donationRequest->bags_num }} </p>

                                        أكياس
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>المشفى</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donationRequest->hospital_name }} </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>رقم الجوال</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donationRequest->patient_phone }} </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="inside">
                                <div class="info">
                                    <div class="special-dark dark">
                                        <p>عنوان المشفى</p>
                                    </div>
                                    <div class="special-light light">
                                        <p>{{ $donationRequest->hospital_address }} </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if ( $donationRequest->notes)

                <div class="text">
                    <h4> <b> الملاحظات</b></h4>
                    <hr>
                    <p>
                        {{ $donationRequest->notes }}
                    </p>
                </div>
                @endif

                <div class="location" id="map" style="height:500px" >
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3418.0770797767814!2d31.409187284906096!3d31.051953681527007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79db9d4d56311%3A0x69ad97566dc9bd76!2z2YXYs9iq2LTZgdmJINin2YTYrtmK2LE!5e0!3m2!1sar!2seg!4v1597910005047!5m2!1sar!2seg" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('front-js')
    <script>
        $("#pac-input").focusin(function() {
            $(this).val('');
        });
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initAutocomplete() {
            var pos = {
                lat: {{ $donationRequest -> latitude }}
                , lng: {{ $donationRequest -> longitude }}
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15
                , center: pos
            });
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
            marker = new google.maps.Marker({
                position: pos
                , map: map
                , title: '{{ $donationRequest->hospital_address }}'
            });

            infoWindow.setContent('{{ $donationRequest->hospital_address }}');
            infoWindow.open(map, marker);

            // move pin and current location
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
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
                /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
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

    @endpush
