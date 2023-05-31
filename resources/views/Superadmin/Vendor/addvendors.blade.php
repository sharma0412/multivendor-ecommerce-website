<style>
    #map {
            height: 400px;
          }

          /* Optional: Makes the sample page fill the window. */
          html,
          body {
            height: 100%;
            margin: 0;
            padding: 0;
          }

          #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
          }

          #infowindow-content .title {
            font-weight: bold;
          }

          #infowindow-content {
            display: none;
          }

          #map #infowindow-content {
            display: inline;
          }

          .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
          }

          #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
          }

          .pac-controls {
            display: inline-block;
            padding: 5px 11px;
          }

          .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
          }

          #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
          }

          #pac-input:focus {
            border-color: #4d90fe;
          }

          #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
          }
          span.logo-lg img ,span.logo-sm img {
        margin-top: 25px;
         }
          .footer{
            display: none;
          }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
    $(document).ready(function(){
      initMap();
    })
          function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: 40.749933, lng: -73.98633 },
              zoom: 13,
            });
            const card = document.getElementById("pac-card");
            const input = document.getElementById("pac-input");
            const biasInputElement = document.getElementById("use-location-bias");
            const strictBoundsInputElement = document.getElementById(
              "use-strict-bounds"
            );
            const options = {
              // componentRestrictions: { country: "us" },
              fields: ["formatted_address", "geometry", "name"],
              origin: map.getCenter(),
              strictBounds: false,
              types: ["establishment"],
            };
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
            const autocomplete = new google.maps.places.Autocomplete(
              input,
              options
            );

            autocomplete.bindTo("bounds", map);
            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");
            infowindow.setContent(infowindowContent);
            const marker = new google.maps.Marker({
              // map,
              anchorPoint: new google.maps.Point(0, -29),
              map:map,
              draggable:true,
              animation: google.maps.Animation.DROP,
              // position: results[0].geometry.location
            });
            autocomplete.addListener("place_changed", () => {
              infowindow.close();
              marker.setVisible(false);
              const place = autocomplete.getPlace();

              if (!place.geometry || !place.geometry.location) {

                window.alert(
                  "No details available for input: '" + place.name + "'"
                );
                return;
              }else{
                $("#input-lattitude").val(place.geometry.location.lat());
                $("#input-longitude").val(place.geometry.location.lng());
              }


              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
              }
              marker.setPosition(place.geometry.location);
              marker.setVisible(true);
              infowindowContent.children["place-name"].textContent = place.name;
              infowindowContent.children["place-address"].textContent =
                place.formatted_address;
              infowindow.open(map, marker);
            });


            function setupClickListener(id, types) {
              const radioButton = document.getElementById(id);
              radioButton.addEventListener("click", () => {
                autocomplete.setTypes(types);
                input.value = "";
              });
            }
            setupClickListener("changetype-all", []);
            setupClickListener("changetype-address", ["address"]);
            setupClickListener("changetype-establishment", ["establishment"]);
            setupClickListener("changetype-geocode", ["geocode"]);
            biasInputElement.addEventListener("change", () => {
              if (biasInputElement.checked) {
                autocomplete.bindTo("bounds", map);
              } else {

                autocomplete.unbind("bounds");
                autocomplete.setBounds({
                  east: 180,
                  west: -180,
                  north: 90,
                  south: -90,
                });
                strictBoundsInputElement.checked = biasInputElement.checked;
              }
              input.value = "";
            });
            strictBoundsInputElement.addEventListener("change", () => {
              autocomplete.setOptions({
                strictBounds: strictBoundsInputElement.checked,
              });

              if (strictBoundsInputElement.checked) {
                biasInputElement.checked = strictBoundsInputElement.checked;
                autocomplete.bindTo("bounds", map);
              }
              input.value = "";
            });


            google.maps.event.addListener(marker, 'dragend', function(marker){
            var latLng = marker.latLng;
            currentLatitude = latLng.lat();
            currentLongitude = latLng.lng();
          console.log(currentLongitude,currentLatitude)
           $("#input-lattitude").val(currentLatitude);
           $("#input-longitude").val(currentLongitude);

          var latlng = new google.maps.LatLng(currentLatitude, currentLongitude);

                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            // alert("Location: " + results[1].formatted_address);
                            input.value = results[1].formatted_address;
                        }
                    }
                });

         });


            //  function GetAddress(lat,lng) {
            //     var lat = lat;
            //     var lng = lng;
            //     var latlng = new google.maps.LatLng(lat, lng);
            //     var geocoder = geocoder = new google.maps.Geocoder();
            //     geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            //         if (status == google.maps.GeocoderStatus.OK) {
            //             if (results[1]) {
            //                 alert("Location: " + results[1].formatted_address);
            //             }
            //         }
            //     });
            // }


          }


        </script>
@extends('Superadmin.utils.master')

@section('content')

@php
    $id=isset($_GET['id']) ? $_GET['id'] : '';
    $catdate= isset($vendor->category) ? explode(',',$vendor->category) : '';

@endphp
        <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card col-md-6 d-block mx-auto">
                                    <div class="card-body">
                                        @if($id == '')
                                        <h5 class="card-title">Add Store</h5>
                                        @else
                                        <h5 class="card-title">Edit Store</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('savesvendor')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="form-group ">
                                               <label for="example-email-input1" class="col-form-label pt-0">Category</label>
                                               <div class="">

                                                   <select id="multiple" class="js-states form-control" multiple required name="category[]">
                                                       @foreach ($category as $cat)
                                                       <option value="{{$cat->id}}" @if($id != '') {{in_array($cat->id,$catdate) ? 'selected' : ''}} @endif>{{$cat->name}}</option>
                                                       @endforeach
                                                  </select>
                                               </div>
                                           </div>
                                            <div class="form-group ">

                                                 @if($id != '')
                                               <img class="" src="{{isset($vendor->profile) ? $vendor->profile : ''}}" width="50px" height="50px"  >
                                               <br>  @endif
                                                <label for="example-email-input1" class="col-form-label pt-0">Image</label>

                                                <div class="">
                                                    <input class="form-control" type="file" {{isset($vendor->profile) ? '' : 'required'}} name="profile"  >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Store Name</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="username" required value="{{isset($vendor->username) ? $vendor->username : ''}}">
                                                </div>
                                            </div>
                                          <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Email</label>
                                                <div class="">
                                                    <input class="form-control" type="email" name="email" required value=" {{isset($vendor->email) ? $vendor->email  : ''}} " >
                                                    <span style="color:red;">
                                                        @if($errors->first('email'))
                                                    {{$errors->first('email')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Phone</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="phone" required value="{{isset($vendor->mobile) ? $vendor->mobile : ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Description</label>
                                                <div class="">
                                                        <textarea class="form-control"  name="description" required >{{isset($vendor->description) ? $vendor->description : ''}}</textarea>

                                                </div>
                                            </div>
                                        {{-- map --}}
                                            <div class=" mb-5">
                                                <div class="">
                                                    <span class="required" style="color:red;font-size:24px;" id="errormsg"></span>
                                                    <label for="select2-demo-1" class="control-label" style="">Address <span class="required" style="color:red;font-size:24px;">*</span></label>

                                                        <input type="hidden" id="input-longitude" name="longitude" class="form-control" value="{{isset($vendor->longitude) ? $vendor->longitude : ''}}" required>
                                                        <input type ="hidden" id="input-lattitude" name="latitude"  class ="form-control" value="{{isset($vendor->latitude) ? $vendor->latitude : ''}}" required>
                                                    </div>

                                                    <div class="pac-card" id="pac-card">
                                                        <div>
                                                            <div id="title" > Search<i class="menu-icon zmdi zmdi-caret-down-circle zmdi-hc-md"></i></div>
                                                            <div id="type-selector" class="pac-controls">
                                                                <input
                                                                    type="hidden"
                                                                    name="type"
                                                                    id="changetype-all"
                                                                    checked="checked"
                                                                />
                                                                <!--  <label for="changetype-all">All</label> -->

                                                                <input type="hidden" name="type" id="changetype-establishment" />
                                                                <!--    <label for="changetype-establishment">Establishments</label> -->

                                                                <input type="hidden" name="type" id="changetype-address" />
                                                                <!-- <label for="changetype-address">Addresses</label> -->

                                                                <input type="hidden" name="type" id="changetype-geocode" />
                                                                <!--  <label for="changetype-geocode">Geocodes</label> -->
                                                            </div>
                                                            <br />
                                                            <div id="strict-bounds-selector" class="pac-controls">
                                                                <input type="hidden" id="use-location-bias" value="" checked />
                                                                <!--  <label for="use-location-bias">Bias to map viewport</label> -->

                                                                <input type="hidden" id="use-strict-bounds" value="" />
                                                                <!-- <label for="use-strict-bounds">Strict bounds</label> -->
                                                            </div>
                                                        </div>
                                                        <div id="pac-container">
                                                            <input id="pac-input" type="text" placeholder="Enter a location" name="address" value="{{isset($vendor->address) ? $vendor->address : ''}}"/>
                                                        </div>
                                                    </div>
                                                    <div id="map"></div>
                                                    <div id="infowindow-content">
                                                        <span id="place-name" class="title"></span><br />
                                                        <span id="place-address"></span>
                                                    </div>
                                                </div>

                                            <button type="submit" class="btn btn-primary w-lg">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
            <script>
              $("#multiple").select2({
                  placeholder: "Select a Category",
                  allowClear: true
              });
            </script>
              <script
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFkw6-U8mAQEGTOC77ZYrIojD4isGoNgg&callback=initMap&libraries=places&v=weekly"
              async></script>
 @endsection


