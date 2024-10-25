@extends('layouts.frontend_dashboard')

@section('content')

<div class="user-profile-wrapper">
    {{-- <div class="row">
       <div class="col-md-6 col-lg-4">
          <div class="dashboard-widget dashboard-widget-color-1">
             <div class="dashboard-widget-info">
                <h1>{{ $allUpcommingBooking ?? 0 }}</h1>
                <span>Pending Booking</span>
             </div>
             <div class="dashboard-widget-icon">
                <i class="fal fa-list"></i>
             </div>
          </div>
       </div>
       <div class="col-md-6 col-lg-4">
          <div class="dashboard-widget dashboard-widget-color-2">
             <div class="dashboard-widget-info">
                <h1>{{ $allTotalBooking ?? 0 }}</h1>
                <span>Total Booking</span>
             </div>
             <div class="dashboard-widget-icon">
                <i class="fal fa-eye"></i>
             </div>
          </div>
       </div>
       <div class="col-md-6 col-lg-4">
          <div class="dashboard-widget dashboard-widget-color-3">
             <div class="dashboard-widget-info">
                <h1>{{ $allCancelBooking ?? 0 }}</h1>
                <span>Cancel Booking</span>
             </div>
             <div class="dashboard-widget-icon">
                <i class="fal fa-xmark-circle"></i>
             </div>
          </div>
       </div>
    </div> --}}
    <div class="row">
       <div class="col-lg-12">
          <div class="user-profile-card">
             <h4 class="user-profile-card-title">Payment History</h4>
             <div class="table-responsive" id="payment_history">

             </div>
          </div>
       </div>
    </div>
 </div>


@endsection

@push('css')
<style>

</style>
@endpush
@push('scripts')
<script>

$(document).ready(function() {
    $('#booking_id').select2({
        placeholder: 'Select Booking ID', // Optional placeholder
        allowClear: true                   // Allows the user to clear the selection
    });

    $('#choose_reason').select2({
        placeholder: 'Select Reason', // Optional placeholder
        allowClear: true                   // Allows the user to clear the selection
    });

    fetchPaymentHistory();
    function fetchPaymentHistory(){
        var checkUserUrl = '{{ route("customer.fetchpaymenthistory") }}';
        var csrfToken = '{{ csrf_token() }}';

        $.ajax({
            url: checkUserUrl,
            type: 'GET',
            //dataType: 'json',
            data: { action: 'checkuser', _token: csrfToken },
            success: function(data) {
                //console.log(data);
                //if (data.pending_booking) {
                    $('#payment_history').html(data);

                    // Destroy any existing DataTable instances on this element
                    if ($.fn.DataTable.isDataTable('.table')) {
                            $('.table').DataTable().destroy();
                        }

                    // Initialize DataTable after inserting the data
                    $('.table').DataTable({
                        info: false,
                        ordering: false,
                        paging: true
                    });
                //}
            }
        });
    }
});
</script>

@endpush
