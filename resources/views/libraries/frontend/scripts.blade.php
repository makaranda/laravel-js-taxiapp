<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('public/assets/js/paginathing.js')}}"></script>
<script src="{{ url('public/assets/js/jquery.redirect.js')}}"></script>
<script src="{{ url('public/assets/js/parsley.js')}}"></script>
{{-- <script src="{{ url('public/assets/js/select2.min.js')}}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/polyline/1.1.1/polyline.js"></script> --}}
{{-- <script src="https://unpkg.com/@mapbox/polyline@1.1.1/lib/polyline.js"></script> --}}
{{-- <script src="{{ url('public/assets/js/polyline.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/@mapbox/polyline@1.1.1/lib/polyline.js"></script> --}}
<div id="validationAlertArea"></div>
<div  class="alert alert-danger alert-dismissible d-none">
    <button type="button" class="btn-close"></button>
    <strong>Warning!</strong> <span class="alert_messages"></span>
  </div>
<script>
$(document).ready(function(){
    flatpickr("#nav_pick_up_time", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true
    });

    var now = new Date();
    var currentTime = formatAMPM(now);
    $('#pick_up_time').val(currentTime);
    $('#nav_pick_up_time').val(currentTime);

    $('.nav-booking-btn').on('click',function(){
        //console.log('Booking ..!!');
        $('#bookingModal').modal('show');
    });

    var encodedPolyline = "e}gi@w{lfNSzAMBTeBDaAKe@AG@GJGD@FBh@@vA@rHInFGdCYPCSqCOsAG{B@aA?E?e@M]a@W?OFuCBqAi@c@a@k@yCcGe@u@MQ`A}@xAuARQ|A{AjAiAdCaCTYWa@AC";

    // Use the polyline.decode function
    var decodedCoordinates = polyline.decode(encodedPolyline);

    // Log the decoded coordinates to the console
    //console.log('Polyline testing : '+decodedCoordinates);
    // var intervalID = setInterval(function() {
    //     checkCurrentBooking();
    // }, 5000);

    $('#pickuplocation,#navpickuplocation').on('click', function() {
        console.log("pickup");
        if ($(this).attr('id') === 'pickuplocation') {
            $('#formType').val("pickup");
        }else if($(this).attr('id') === 'navpickuplocation'){
            $('#formType').val("navpickup");
        }
        $('#locationmodallbl').text("Pickup Location");
        $('#locationmodal').modal('show');
    });

    $('#dropofflocation,#navdropofflocation').on('click', function() {
        //console.log("dropoff");
        if ($(this).attr('id') === 'dropofflocation') {
            $('#formType').val("dropoff");
        }else if($(this).attr('id') === 'navdropofflocation'){
            $('#formType').val("navdropoff");
        }

        $('#locationmodallbl').text("Dropoff Location");
        $('#locationmodal').modal('show');
    });

    $('#locationPickup').on('submit', function(event) {
        event.preventDefault(); // Corrected 'preventDefault' method
        if($("#formType").val() == 'pickup'){
            $('#picup_long').val($('#longatude').val());
            $('#picup_lati').val($('#latitude').val());

            $('#pickuplocation').val('Assign the Location');
            $('#pickuplocation').css({'background-color':'#7cfc0029','color':'#15ad15'});
        }else if($("#formType").val() == 'navpickup'){
            $('#nav_picup_long').val($('#longatude').val());
            $('#nav_picup_lati').val($('#latitude').val());

            $('#navpickuplocation').val('Assign the Location');
            $('#navpickuplocation').css({'background-color':'#7cfc0029','color':'#15ad15'});
        }else if($("#formType").val() == 'dropoff'){
            $('#dropoff_long').val($('#longatude').val());
            $('#dropoff_lati').val($('#latitude').val());

            $('#dropofflocation').val('Assign the Location');
            $('#dropofflocation').css({'background-color':'#7cfc0029','color':'#15ad15'});
        }else if($("#formType").val() == 'navdropoff'){
            $('#nav_dropoff_long').val($('#longatude').val());
            $('#nav_dropoff_lati').val($('#latitude').val());

            $('#navdropofflocation').val('Assign the Location');
            $('#navdropofflocation').css({'background-color':'#7cfc0029','color':'#15ad15'});
        }
        $('#locationmodal').modal('hide');
        //console.log("locationPickup");
    });

    var map;
    $('#locationmodal').on('shown.bs.modal', function () {
        // Check if map already exists to avoid reinitializing
        //console.log('window mapInitialized' + window.mapInitialized);
        //if (!window.mapInitialized) {
            //window.mapInitialized = true; // Prevent reinitialization
            //console.log('testi pickup');
            // Use browser's geolocation to get the current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Get the coordinates
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    //alert();
                    console.log('Latitude:', lat, 'Longitude:', lng); // Log the coordinates
                    $('#latitude').val(lat);
                    $('#longatude').val(lng);

                    // Initialize Leaflet map centered on user's location
                    var map = L.map('mapid').setView([lat, lng], 13);

                    // Add OpenStreetMap tiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    // Create a draggable marker for the user's current location
                    var marker = L.marker([lat, lng], { draggable: true }).addTo(map)
                        .bindPopup('Your current location.')
                        .openPopup();

                    // Listen for the dragend event to update coordinates
                    marker.on('dragend', function(e) {
                        var newLatLng = marker.getLatLng();
                        $('#latitude').val(newLatLng.lat);
                        $('#longatude').val(newLatLng.lng);
                        marker.bindPopup('Moved to: ' + newLatLng.lat.toFixed(5) + ', ' + newLatLng.lng.toFixed(5)).openPopup();
                    });

                    // Listen for map clicks to add a new marker at the clicked location
                    map.on('click', function(e) {
                        var clickedLat = e.latlng.lat;
                        var clickedLng = e.latlng.lng;

                        // Update input fields with the clicked location
                        $('#latitude').val(clickedLat);
                        $('#longatude').val(clickedLng);

                        // Remove the previous marker if it exists and create a new one
                        if (marker) {
                            map.removeLayer(marker); // Remove the old marker
                        }

                        // Add a new marker at the clicked location
                        marker = L.marker([clickedLat, clickedLng], { draggable: true }).addTo(map)
                            .bindPopup('New location: ' + clickedLat.toFixed(5) + ', ' + clickedLng.toFixed(5))
                            .openPopup();

                        // Update the coordinates when the new marker is dragged
                        marker.on('dragend', function(e) {
                            var newLatLng = marker.getLatLng();
                            $('#latitude').val(newLatLng.lat);
                            $('#longatude').val(newLatLng.lng);
                            marker.bindPopup('Moved to: ' + newLatLng.lat.toFixed(5) + ', ' + newLatLng.lng.toFixed(5)).openPopup();
                        });
                    });

                }, function(error) {
                    console.error('Geolocation error:', error);
                    alert('Unable to retrieve your location.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        //}
    });



    $('#scroll-top2').on('click',function(){
        checkCurrentBooking();
    });

    // setTimeout(function() {
    //     checkCurrentBooking();
    // }, 5000);
    var map_location;
    $('#customModal').on('shown.bs.modal', function () {
        var checkUserUrl = '{{ route("booking.checkbooking") }}';
        var csrfToken = '{{ csrf_token() }}';
        var map_booking_id = $('#map_booking_id').val();
        $.ajax({
            url: checkUserUrl,
            type: 'POST',
            dataType: 'json',
            data: { action: 'checkuser', _token: csrfToken,map_booking_id:map_booking_id },
            success: function(data) {
                if (data.status == 1 && data.booking == 1) {
                    var customer_name = data.customer_name;
                    // Prevent map reinitialization
                    if (!window.mapInitialized) {
                        var pickupCoords = data.pick_up_location.split(',').map(Number); // Convert string to [lat, lng]
                        var dropoffCoords = data.drop_off_location.split(',').map(Number); // Convert string to [lat, lng]

                        var map_location = L.map('showMap').setView(pickupCoords, 12);

                        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        //     attribution: '© OpenStreetMap contributors',
                        //     maxZoom: 18
                        // }).addTo(map_location);

                        // L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                        //     attribution: '&copy; <a href="https://carto.com/">CartoDB</a> contributors',
                        //     subdomains: 'abcd',
                        //     maxZoom: 19
                        // }).addTo(map_location);

                        L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
                            attribution: '&copy; CyclOSM & OpenStreetMap contributors',
                            maxZoom: 17
                        }).addTo(map_location);


                        window.mapInitialized = true; // Set map initialization flag

                        // Fetch the route from server
                        var checkUserUrl2 = '{{ route("booking.getroute") }}';
                        var checkUserUrl3 = '{{ route("booking.updatepricedistance") }}';
                        var csrfToken2 = '{{ csrf_token() }}';

                        $.ajax({
                            url: checkUserUrl2,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                action: 'checkuser',
                                start_lat: pickupCoords[0],
                                start_lng: pickupCoords[1],
                                end_lat: dropoffCoords[0],
                                end_lng: dropoffCoords[1]
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                console.log('AJAX Success Response:', data);

                                if (data.routes && data.routes.length > 0) {
                                    var polylineEncoded = data.routes[0].geometry; // Encoded polyline
                                    console.log('Encoded polyline:', polylineEncoded);

                                    // Get the distance from the response in meters
                                    var distanceInMeters = data.routes[0].segments[0].distance;
                                    var distanceInKilometers = (distanceInMeters / 1000).toFixed(2); // Convert to kilometers and round to 2 decimal places
                                    console.log('Distance (meters):', distanceInMeters);
                                    console.log('Distance (kilometers):', distanceInKilometers);

                                    $.ajax({
                                        url: checkUserUrl3,
                                        type: 'GET',
                                        dataType: 'json',
                                        data: {
                                            action: 'checkuser',
                                            distancemeeter: distanceInMeters,
                                            distancekm: distanceInKilometers,
                                            map_booking_id: map_booking_id,
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(data) {
                                            console.log(data);
                                            $('#showModalDestances').text(data.distancekm+'km');
                                            $('#showModalCharge').text(data.totalCharged);
                                        }
                                    });
                                    try {
                                        // Decode the polyline
                                        var decodedCoordinates = polyline.decode(polylineEncoded);
                                        console.log('Decoded coordinates:', decodedCoordinates);

                                        // Fix the coordinate order to [lat, lng] (Leaflet expects this order)
                                        var latlngs = decodedCoordinates.map(coord => [coord[0], coord[1]]); // Swap lat and lng
                                        console.log('latlngs',latlngs);
                                        // Draw the polyline on the map with the corrected coordinates
                                        var polylineLayer = L.polyline(latlngs, { color: 'red', weight: 5 }).addTo(map_location);

                                        // Fit the map to the polyline bounds
                                        map_location.fitBounds(polylineLayer.getBounds());

                                        var pickupPopupContent = `
                                            <div>
                                                <h6>${customer_name}</h6>
                                                <p>This is the location where you will be picked up.</p>
                                            </div>
                                        `;

                                        var dropoffPopupContent = `
                                            <div>
                                                <h6>${customer_name}</h6>
                                                <p>This is the location where you will be dropped off.</p>
                                            </div>
                                        `;

                                        var pickupIcon = L.icon({
                                            iconUrl: '{{ url("public/assets/img/icon/path_to_pickup_icon2.png") }}',
                                            iconSize: [38, 45],
                                            iconAnchor: [19, 45],
                                            popupAnchor: [0, -45]
                                        });

                                        var dropoffIcon = L.icon({
                                            iconUrl: '{{ url("public/assets/img/icon/path_to_dropoff_icon2.png") }}',
                                            iconSize: [38, 45],
                                            iconAnchor: [19, 45],
                                            popupAnchor: [0, -45]
                                        });

                                        // Create the markers for pickup and drop-off points
                                        var pickupMarker = L.marker(pickupCoords, { icon: pickupIcon }).addTo(map_location);
                                        var dropoffMarker = L.marker(dropoffCoords, { icon: dropoffIcon }).addTo(map_location);

                                        // Bind the popups to the markers with close buttons and offset to display them above the markers
                                        pickupMarker.bindPopup(pickupPopupContent, { closeButton: true, autoClose: false, closeOnClick: false, offset: [0, 0] });
                                        dropoffMarker.bindPopup(dropoffPopupContent, { closeButton: true, autoClose: false, closeOnClick: false, offset: [0, 0] });

                                        // Automatically open the popups when the page loads
                                        pickupMarker.openPopup();  // Opens the pickup popup on page load
                                        //dropoffMarker.openPopup();  // Opens the drop-off popup on page load


                                    } catch (error) {
                                        console.error('Error decoding polyline:', error);
                                    }
                                } else {
                                    console.error('No routes found');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Request Error:', error);
                            }
                        });

                    }

                    // Show the modal after initializing the map
                    $('#scroll-top2').removeClass('d-none');
                    //$('#customModal').modal('show');
                } else {
                    $('#scroll-top2').addClass('d-none');
                }

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
    // checkCurrentBooking();
    // function checkCurrentBooking() {

    //     var checkUserUrl = '{{ route("customer.fetchpendingbooking") }}';
    //     var csrfToken = '{{ csrf_token() }}';

    //     $.ajax({
    //         url: checkUserUrl,
    //         type: 'POST',
    //         dataType: 'json',
    //         data: { action: 'checkuser', _token: csrfToken },
    //         success: function(data) {
    //             if (data.status == 1 && data.booking == 1) {
    //                 $('#scroll-top2').removeClass('d-none');
    //                 $('#customModal').modal('show');
    //             }
    //         }
    //     });

    // }





        // Clear the interval when the modal is shown
    $('#customModal').on('shown.bs.modal', function () {
        //clearInterval(intervalID);
    });
        // $('#validationAlertArea .btn-close').on('click',function(){
        //     $('#validationAlertArea alert').addClass('d-none');
        // });

        var myModal = new bootstrap.Modal($('#customModal')[0], {
            backdrop: false, // Disable the backdrop
            //backdrop: 'static', // Prevent closing the modal by clicking outside it
            keyboard: true
        });

        function validateStepFields(step,formType) {
            var isValid = true;
            var errors = [];
            formType = (formType === 'nav-next')?'nav-':'';
            var formName = ''+formType+'step';
            // Clear previous alerts
            $('#validationAlertArea').html(''); // Clear previous error messages
            console.log(step,formType);
            console.log('#' + formType + 'step-' + step + '');
            let vehicleTypeErrorDisplayed = false;
            //$('.alert').text('TESTING');
            // Loop through required fields in the given step
            console.log(formType);
            $('#' + formType + 'step-' + step + ' input, #' + formType + 'step-' + step + ' select').each(function() {
                if ($(this).prop('required')) {
                    if ($(this).val() === "" || $(this).val() === null) {
                        var errorMessage = $(this).attr('data-title') + " is required.";
                        errors.push(errorMessage); // Collect error messages
                        isValid = false;

                    }
                }else if($('input[name="vehicle_type"]:checked').length === 0 && formName == 'step' && !vehicleTypeErrorDisplayed){
                    var errorMessage = "Choose Vehicle field is required.";
                    errors.push(errorMessage); // Collect error messages
                    vehicleTypeErrorDisplayed = true;
                    isValid = false;
                }else if($('input[name="nav_vehicle_type"]:checked').length === 0 && formName == 'nav-step' && !vehicleTypeErrorDisplayed){
                    var errorMessage = "Choose Vehicle field is required.";
                    errors.push(errorMessage); // Collect error messages
                    vehicleTypeErrorDisplayed = true;
                    isValid = false;
                }
            });

            // If there are errors, display them in separate Bootstrap alerts
            if (!isValid) {
                errors.forEach(function(error) {
                    console.log(error);

                    var alertHtml = `<div  class="alert alert-danger alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Warning!</strong> <span class="alert_messages">${error}</span>
                                    </div>`;
                    $('#validationAlertArea').append(alertHtml);
                });
            }

            return isValid;
        }

        // function validateStepFields(step) {
        //     var isValid = true;

        //     // Clear previous alert
        //     $('#validationAlert').addClass('d-none');
        //     $('#validationAlert .alert_messages').text('');
        //     // Loop through required fields in the given step
        //     $('#step-' + step + ' input, #step-' + step + ' select').each(function() {
        //         if ($(this).prop('required')) {
        //             if ($(this).val() === "" || $(this).val() === null) {
        //                 var errorMessage = $(this).attr('data-title') + " is required.";

        //                 // Show the Bootstrap alert with the error message
        //                 $('#validationAlert').removeClass('d-none');
        //                 $('#validationAlert .alert_messages').text(errorMessage);

        //                 isValid = false;
        //                 return false; // Break the loop after the first invalid field
        //             }
        //         }
        //     });

        //     return isValid;
        // }



        $('.next-step').on('click', function() {
            var nextStep = $(this).data('next');
            var currentStep = nextStep - 1;
            var formType = 'next';
            console.log($('#pick_up_time').val());
            if (validateStepFields(currentStep,formType)) {
                $('.form-step').hide(); // Hide all steps
                // Show the next step
                console.log('Next-step : ',nextStep);
                if(nextStep == 2){
                    var checkUserUrl = '{{ route("booking.checkuser") }}'; // Pass the route from Blade to a JS variable
                    var csrfToken = '{{ csrf_token() }}';
                    $.ajax({
                        url: checkUserUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: {action:'checkuser'},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                             console.log('Success: ', data.status);
                            if(data.status == 1){
                                $('#step-3').show();
                            }else{
                                $('#login_username').attr('required', 'required');
                                $('#login_password').attr('required', 'required');
                                $('#step-2').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }else if(nextStep == 3){
                    console.log('Step login');
                    var loginUserUrl = '{{ route("booking.loginuser") }}'; // Pass the route from Blade to a JS variable
                    var logincsrfToken = '{{ csrf_token() }}';
                    console.log(nextStep);
                    $.ajax({
                        url: loginUserUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: $('#formBookingHome').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('login : '+ response.status+' : '+ response.messageType+' : '+ response.message);
                            if(response.status == 1){
                                $('#step-3').show();
                            }else{
                                $('#step-2').show();
                                Swal.fire({
                                    position: "bottom-end",
                                    icon: response.messageType === 'success' ? "success" : "error",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: response.messageType === 'success' ? 4000 : 2500
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }else{
                    $('#step-' + nextStep).show();
                }
            }
        });


        $('.nav-next-step').on('click', function() {
            var nextStep = $(this).data('next');
            var currentStep = nextStep - 1;
            var formType = 'nav-next';
            console.log(formType,nextStep);
            console.log($('#nav_pick_up_time').val());
            if (validateStepFields(currentStep,formType)) {
                $('.nav-form-step').hide(); // Hide all steps
                // Show the next step
                if(nextStep == 2){
                    var checkUserUrl = '{{ route("booking.checkuser") }}'; // Pass the route from Blade to a JS variable
                    var csrfToken = '{{ csrf_token() }}';
                    $.ajax({
                        url: checkUserUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: {action:'checkuser'},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                             console.log('Success: ', data.status);
                            if(data.status == 1){
                                $('#nav-step-3').show();
                            }else{
                                $('#nav_login_username').attr('required', 'required');
                                $('#nav_login_password').attr('required', 'required');
                                $('#nav-step-2').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }else if(nextStep == 3){
                    console.log('Step login');
                    var loginUserUrl = '{{ route("booking.loginuser") }}'; // Pass the route from Blade to a JS variable
                    var logincsrfToken = '{{ csrf_token() }}';
                    console.log(nextStep);
                    $.ajax({
                        url: loginUserUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: $('#navformBookingHome').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('login : '+ response.status+' : '+ response.messageType+' : '+ response.message);
                            if(response.status == 1){
                                $('#nav-step-3').show();
                            }else{
                                $('#nav-step-2').show();
                                Swal.fire({
                                    position: "bottom-end",
                                    icon: response.messageType === 'success' ? "success" : "error",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: response.messageType === 'success' ? 4000 : 2500
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }else{
                    $('#nav-step-' + nextStep).show();
                }
            }
        });

        // Show the previous step when clicking on 'Previous' button
        $('.previous-step').on('click', function() {
            var previousStep = $(this).data('previous');
            $('.form-step').hide(); // Hide all steps
            //$('#step-' + previousStep).show(); // Show the previous step

            console.log(previousStep);
            if(previousStep == 2){
                var checkUserUrl = '{{ route("booking.checkuser") }}'; // Pass the route from Blade to a JS variable
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: checkUserUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {action:'checkuser'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        //console.log('Success: ', data);
                        if(data.status == 1){
                            $('#step-1').show();
                        }else{
                            $('#step-2').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }else{
                $('#step-' + previousStep).show();
            }
        });



        // Show the previous step when clicking on 'Previous' button
        $('.nav-previous-step').on('click', function() {
            var previousStep = $(this).data('previous');
            $('.nav-form-step').hide(); // Hide all steps
            //$('#step-' + previousStep).show(); // Show the previous step

            console.log(previousStep);
            if(previousStep == 2){
                var checkUserUrl = '{{ route("booking.checkuser") }}'; // Pass the route from Blade to a JS variable
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: checkUserUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {action:'checkuser'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        //console.log('Success: ', data);
                        if(data.status == 1){
                            $('#nav-step-1').show();
                        }else{
                            $('#nav-step-2').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }else{
                $('#nav-step-' + previousStep).show();
            }
        });

        //$('#openModalButton').parsley();
        $('#navFormBookingHome').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: "You need to book this taxi..!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.preloader').css({'display':'flex'});
                    var now = new Date();
                    var currentTime = formatAMPM(now);
                    var bookedcsrfToken = '{{ csrf_token() }}';

                    var checkedRadio = $('input[name="nav_vehicle_type"]:checked');
                    var vehicle_type = checkedRadio.attr('data-id');
                    // Correctly create a FormData object by passing the actual form element
                    $.ajax({
                        url: '{{ route("booking.frontpage") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: $(this).serialize()+ '&vehicle_type='+vehicle_type+'',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('.preloader').css({'display':'none'});
                            console.log('Success: ', response);
                            $('#nav-pick_up_time').val(currentTime);
                            if(response.messageType === 'success'){
                                checkCurrentBooking();
                                if ($('#navFormBookingHome').length) {
                                    $('#navFormBookingHome')[0].reset();
                                }
                                $('#map_booking_id').val(response.booking_id);
                                $('#navpickuplocation').css({'background-color':'#fff','color':'#000'});
                                $('#navdropofflocation').css({'background-color':'#fff','color':'#000'});

                                $('#bookingModal').modal('hide');
                            }
                            Swal.fire({
                                position: "bottom-end",
                                icon: response.messageType === 'success' ? "success" : "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: response.messageType === 'success' ? 4000 : 2500
                            });
                            $('#nav-step-3').hide();
                            $('#nav-step-1').show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error Status:', status);         // Error status (e.g., "timeout", "error", etc.)
                            console.error('HTTP Status Code:', xhr.status); // HTTP status code (e.g., 404, 500, etc.)
                            console.error('Response Text:', xhr.responseText); // Server response text
                            $('.preloader').css({'display':'none'});
                            Swal.fire({
                                position: "bottom-end",
                                icon: "error",
                                title: 'Error! \n There was an error processing your booking. '+error+'error',
                                showConfirmButton: false,
                                timer: 6500
                            });
                        }
                    });
                }
            });
        });

        //$('#openModalButton').parsley();
        $('#formBookingHome').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: "You need to book this taxi..!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.preloader').css({'display':'flex'});
                    var now = new Date();
                    var currentTime = formatAMPM(now);
                    var bookedcsrfToken = '{{ csrf_token() }}';

                    var checkedRadio = $('input[name="vehicle_type"]:checked');
                    var vehicle_type = checkedRadio.attr('data-id');
                    // Correctly create a FormData object by passing the actual form element
                    $.ajax({
                        url: '{{ route("booking.frontpage") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: $(this).serialize()+ '&vehicle_type='+vehicle_type+'',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('.preloader').css({'display':'none'});
                            console.log('Success: ', response);
                            $('#formBookingHome')[0].reset();
                            $('#pick_up_time').val(currentTime);
                            if(response.messageType === 'success'){
                                checkCurrentBooking();
                                $('#map_booking_id').val(response.booking_id);
                                $('#pickuplocation').css({'background-color':'#fff','color':'#000'});
                                $('#dropofflocation').css({'background-color':'#fff','color':'#000'});
                            }
                            Swal.fire({
                                position: "bottom-end",
                                icon: response.messageType === 'success' ? "success" : "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: response.messageType === 'success' ? 4000 : 2500
                            });
                            $('#step-3').hide();
                            $('#step-1').show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error Status:', status);         // Error status (e.g., "timeout", "error", etc.)
                            console.error('HTTP Status Code:', xhr.status); // HTTP status code (e.g., 404, 500, etc.)
                            console.error('Response Text:', xhr.responseText); // Server response text
                            $('.preloader').css({'display':'none'});
                            Swal.fire({
                                position: "bottom-end",
                                icon: "error",
                                title: 'Error! \n There was an error processing your booking. '+error+'error',
                                showConfirmButton: false,
                                timer: 6500
                            });
                        }
                    });
                }
            });
        });

        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // If 0, set to 12
            minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes if needed
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

        // $('#vehicleType').on('change', function() {
        //     var type_id = $(this).val();
        //     console.log('testing');
        //     if (type_id) {
        //         form_type = '{{ route("vehicle.models", ":id") }}';
        //         form_type = form_type.replace(':id', type_id);
        //         console.log('testing - ' +form_type);
        //         // Make an AJAX request to fetch the vehicle models
        //         $.ajax({
        //             url: ''+form_type+'',
        //             type: 'GET',
        //             dataType: 'json',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(data) {
        //                 console.log('success'+ data);
        //                 //$('#vehicleModel').niceSelect('destroy');
        //                 //$('#vehicleModel').replaceWith('<select id="vehicleModel" class="select form-control"></select>');

        //                 $('#vehicleModel').empty();
        //                 $('#vehicleModel').append('<option value="">Choose Model</option>');

        //                 $.each(data, function(key, value) {
        //                     console.log('success'+ value.name);
        //                     $('#vehicleModel').append('<option value="' + value.id + '">' + value.name + '</option>');
        //                 });

        //             }
        //         });
        //     } else {
        //         $('#vehicleModel').niceSelect('destroy');
        //         $('#vehicleModel').empty();
        //         $('#vehicleModel').append('<option value="">Choose Model</option>');


        //     }
        // });


        $('.logoutBtn').on('click',function(event){
            event.preventDefault(); // Prevent immediate navigation
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with the logout (you can customize the action here)
                    window.location.href = "{{ route('login.logout') }}"; // Adjust to your actual logout route
                }
            });
        });
    });
    </script>
