@extends('layouts.app')

@section('content')

<h1>Test</h1>

@endsection

@push('css')
<style>

</style>
@endpush
@push('scripts')
<script>
    // fetchPendingBooking();
    // function fetchPendingBooking(){
    //     var checkUserUrl = '{{ route("driver.fetchdriverpendingbooking") }}';
    //     var csrfToken = '{{ csrf_token() }}';

    //     $.ajax({
    //         url: checkUserUrl,
    //         type: 'GET',
    //         //dataType: 'json',
    //         data: { action: 'checkuser', _token: csrfToken },
    //         success: function(data) {
    //             //console.log(data);
    //             //if (data.pending_booking) {
    //                 $('#pendingBooking').html(data);
    //             //}
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error:', error,status,xhr);
    //         }
    //     });
    // }
</script>

@endpush
