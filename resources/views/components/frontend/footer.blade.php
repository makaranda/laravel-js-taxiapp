</main>
<footer class="footer-area">
   <div class="footer-widget">
      <div class="container">
         <div class="row footer-widget-wrapper pt-120 pb-70">
            <div class="col-md-6 col-lg-4">
               <div class="footer-widget-box about-us">
                  <a href="#" class="footer-logo">
                  <img src="{{ url('public/assets/img/logo/logo-light.png') }}" alt="Logo"/>
                  </a>
                  <p class="mb-3">
                     We are many variations of passages available but the majority have suffered alteration
                     in some form by injected humour words believable.
                  </p>
                  <ul class="footer-contact">
                     <li><a href="tel:+94773944180"><i class="far fa-phone"></i>+94 7739 44 180</a></li>
                     <li><i class="far fa-map-marker-alt"></i>36 Bauddhaloka Mawatha, Gampaha</li>
                     <li><a href="mailto:makarandapathirana@gmail.com"><i class="far fa-envelope"></i><span class="__cf_email__">[email&#160;protected]</span></a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-6 col-lg-2">
               <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Quick Links</h4>
                  <ul class="footer-list">
                     <li><a href="#"><i class="fas fa-caret-right"></i> About Us</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Update News</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Terms Of Service</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Privacy policy</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Support Center</h4>
                  <ul class="footer-list">
                     <li><a href="#"><i class="fas fa-caret-right"></i> FAQ's</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Book A Ride</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                     <li><a href="#"><i class="fas fa-caret-right"></i> Sitemap</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Newsletter</h4>
                  <div class="footer-newsletter">
                     <p>Subscribe Our Newsletter To Get Latest Update And News</p>
                     <div class="subscribe-form">
                        <form action="#">
                           <input type="email" class="form-control" placeholder="Your Email">
                           <button class="theme-btn" type="submit">
                           Subscribe Now <i class="far fa-paper-plane"></i>
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="copyright">
      <div class="container">
         <div class="row">
            <div class="col-md-6 align-self-center">
               <p class="copyright-text">
                  &copy; Copyright <span id="date"></span> <a href="#"> Taxica </a> All Rights Reserved.
               </p>
            </div>
            <div class="col-md-6 align-self-center">
               <ul class="footer-social">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                  <li><a href="#"><i class="fab fa-youtube"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</footer>
<a href="#" id="scroll-top2" class="map-icon d-none"><img src="{{ url('public/assets/img/map-point.png') }}" alt=""></a>
<a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
{{-- <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script> --}}


<!-- Modal -->
<div class="modal fade" id="customModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-bottom-right">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Booking Routes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <input type="hidden" name="pick_up_location" id="pick_up_location"/>
          <input type="hidden" name="drop_off_location" id="drop_off_location"/>
          <div id="showMap"  style="height: 400px;width:100%;"></div>
        </div>
        <div class="modal-footer d-none">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Book Your Ride</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" id="navFormBookingHome">
                <input type="hidden" name="bookingNavFormType" value="navi-form"/>

                <input type="hidden" name="nav_picup_long" id="nav_picup_long"/>
                <input type="hidden" name="nav_picup_lati" id="nav_picup_lati"/>

                <input type="hidden" name="nav_dropoff_long" id="nav_dropoff_long"/>
                <input type="hidden" name="nav_dropoff_lati" id="nav_dropoff_lati"/>
                <div class="row nav-form-step" id="nav-step-1">
                   <div class="col-lg-3">
                      <div class="form-group">
                         <label>Pick Up Location</label>
                         <input type="text" class="form-control" id="navpickuplocation" name="navpickuplocation" data-title="Pickup Location" placeholder="Click Here - Get Pickup" required/>
                         <i class="far fa-location-dot"></i>
                      </div>
                   </div>
                   <div class="col-lg-3">
                      <div class="form-group">
                         <label>Drop Off Location</label>
                         <input type="text" class="form-control" id="navdropofflocation" name="navdropofflocation" data-title="Dropoff Location" placeholder="Click Here - Get Dropoff" required/>
                         <i class="far fa-location-dot"></i>
                      </div>
                   </div>
                   <div class="col-lg-2">
                      <div class="form-group">
                         <label>Passengers</label>
                         <input type="number" class="form-control" placeholder="Passengers" min="1" step="1" max="4" value="1" data-title="Passengers" name="navpassengers" required>
                         <i class="far fa-user-tie"></i>
                      </div>
                   </div>
                   <div class="col-lg-2">
                      <div class="form-group">
                         <label>Pick Up Date</label>
                         <input type="text" class="form-control date-picker" min="{{ date('Y-m-d') }}" data-title="Pickup Date" name="nav_pick_up_date" value="{{ date('Y-m-d') }}" placeholder="MM/DD/YY"  required>
                         <i class="far fa-calendar-days"></i>
                      </div>
                   </div>
                   <div class="col-lg-2">
                      <div class="form-group">
                         <label>Pick Up Time</label>
                         <input type="text" class="form-control time-picker" value="{{ date('h:i A') }}" placeholder="00:00 AM" data-title="Pickup Time" name="nav_pick_up_time" id="nav_pick_up_time" required>
                         <i class="far fa-clock"></i>
                      </div>
                   </div>

                   <div class="col-lg-12">
                       <div class="form-group">
                          <label>Choose Vehicle</label>
                          <div class="image-radio-group">
                               @foreach ($allVehicleTypes as $key => $vehicleType)
                                   @php
                                       if($vehicleType->id == 1){
                                           $checked = 'checked';
                                       }else{
                                           $checked = '';
                                       }
                                   @endphp
                                   <div class="image-container">
                                       <input type="radio" name="nav_vehicle_type" data-id="{{ $vehicleType->id }}" data-title="Vehicle Type" id="navradio{{ $key+1 }}"  {{ $checked }}>
                                       <img src="{{ url('public/assets/img/icon/vehicle-types/'.$vehicleType->icon.'') }}" alt="{{ $vehicleType->name }}" onclick="document.getElementById('navradio{{ $key+1 }}').click();">
                                       <p class="fw-bold text-dark">{{ $vehicleType->name }}</p>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                    </div>
                   <div class="col-lg-3 align-self-end mt-3">
                      <button class="theme-btn nav-next-step" data-next="2" type="button">Next <i class="fas fa-arrow-right"></i></button>
                   </div>
                </div>
                <div class="row nav-form-step mt-4 justify-content-center" id="nav-step-2" style="display:none;">
                   <div class="col-lg-6">
                       <div class="form-group">
                          <label>User Name</label>
                          <input type="text" class="form-control" placeholder="Type Your Email or Phone" name="nav_login_username" data-title="Login Email or Password" id="nav_login_username">
                          {{-- <i class="far fa-clock"></i> --}}
                       </div>
                    </div>

                   <div class="col-lg-6">
                       <div class="form-group">
                          <label>Password</label>
                          <input type="text" class="form-control" placeholder="Type Your Password" data-title="Login Password" name="nav_login_password" id="nav_login_password">
                          {{-- <i class="far fa-clock"></i> --}}
                       </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                       <h5>You've not registered yet this sytem. Please below register button. after registerd you please use these steps as well..!!</h5>
                    </div>
                   <div class="col-lg-12 align-self-end mt-4">
                       <div class="row mt-4 justify-content-center">
                           <div class="col-12 col-md-4">
                               <button type="button" class="theme-btn nav-previous-step" data-previous="1"><i class="fas fa-arrow-left"></i> Previous</button>
                           </div>
                           <div class="col-12 col-md-4">
                               <button type="button" class="theme-btn3">Register Now <i class="fas fa-arrow-top"></i></button>
                           </div>
                           <div class="col-12 col-md-4">
                               <button type="button" class="theme-btn2 nav-next-step" data-next="3">Next <i class="fas fa-arrow-right"></i></button>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="row nav-form-step mt-4 justify-content-center" id="nav-step-3" style="display:none;">
                   <div class="col-lg-12">
                       <div class="form-group text-center">
                          <h2>Great!</h2>
                          <h5 class="mt-4">You've completed all the necessary steps. Please submit your booking to finalize the process.</h5>
                       </div>

                       <div class="col-lg-12 align-self-end mt-4">
                           <div class="row mt-4 justify-content-center">
                               <div class="col-12 col-md-6">
                                   <button type="button" class="theme-btn nav-previous-step" data-previous="2"><i class="fas fa-arrow-left"></i> Previous</button>
                               </div>
                               <div class="col-12 col-md-6 text-right">
                                   <button type="submit" class="theme-btn2 nav-submit-step" data-next="3">Book Now <i class="fas fa-arrow-right"></i></button>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
             </form>
        </div>
        <div class="modal-footer d-none">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


<script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ url('public/assets/js/modernizr.min.js') }}"></script>
<script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('public/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('public/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.appear.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ url('public/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('public/assets/js/counter-up.js') }}"></script>
<script src="{{ url('public/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('public/assets/js/jquery.timepicker.min.js') }}"></script>
{{-- <script src="{{ url('public/assets/js/jquery.nice-select.min.js') }}"></script> --}}
<script src="{{ url('public/assets/js/wow.min.js') }}"></script>
<script src="{{ url('public/assets/js/polyline.js') }}"></script>
<script src="{{ url('public/assets/js/main.js') }}?v={{ date('is') }}"></script>
{{-- <script src="https://unpkg.com/@mapbox/polyline@1.1.1/lib/polyline.js"></script> --}}

    <script>
        $(document).ready(function() {

        });
        //$('.select').niceSelect();

        // let watchId; // Variable to store the watchPosition ID
        // startWatchingLocation();

        // function startWatchingLocation() {
        //     // Check if geolocation is supported
        //     if (navigator.geolocation) {
        //         // Request user's location with high accuracy
        //         watchId = navigator.geolocation.watchPosition(
        //             showPosition,
        //             showError,
        //             {
        //                 enableHighAccuracy: true, // Request the best possible accuracy
        //                 timeout: 10000, // Wait 10 seconds before timing out
        //                 maximumAge: 0 // Don't use cached location
        //             }
        //         );
        //     } else {
        //         //alert("Geolocation is not supported by this browser.");
        //     }
        // }

        // function stopWatchingLocation() {
        //     // Stop tracking location changes
        //     if (watchId) {
        //         navigator.geolocation.clearWatch(watchId);
        //         console.log('Location tracking stopped.');
        //     }
        // }

        // function showPosition(position) {
        //     // Extract latitude, longitude, and accuracy
        //     const lat = position.coords.latitude;
        //     const lon = position.coords.longitude;
        //     const accuracy = position.coords.accuracy; // Accuracy in meters

        //     console.log(`Latitude: ${lat}, Longitude: ${lon}, Accuracy: ${accuracy} meters`);

        //     if (accuracy > 50) { // For example, 50 meters threshold
        //         //alert('Location accuracy is low. Please move to an open area for better accuracy.');
        //     }
        //     // You can send this data to your Laravel backend
        //     // Example: sendLocationToServer(lat, lon);
        // }

        // function showError(error) {
        //     // Handle geolocation errors
        //     switch (error.code) {
        //         case error.PERMISSION_DENIED:
        //             alert("User denied the request for Geolocation.");
        //             break;
        //         case error.POSITION_UNAVAILABLE:
        //             alert("Location information is unavailable.");
        //             break;
        //         case error.TIMEOUT:
        //             alert("The request to get user location timed out.");
        //             break;
        //         case error.UNKNOWN_ERROR:
        //             alert("An unknown error occurred.");
        //             break;
        //     }
        // }

        // // Optional: function to send location data to your Laravel backend
        // function sendLocationToServer(lat, lon) {
        //     fetch('/save-location', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify({
        //             latitude: lat,
        //             longitude: lon
        //         })
        //     })
        //     .then(response => response.json())
        //     .then(data => console.log('Location saved:', data))
        //     .catch((error) => console.error('Error:', error));
        // }
    </script>


</body>
</html>
