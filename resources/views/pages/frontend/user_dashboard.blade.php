@extends('layouts.frontend_dashboard')

@section('content')

             <div class="user-profile-wrapper">
                <div class="row">
                   <div class="col-md-6 col-lg-4">
                      <div class="dashboard-widget dashboard-widget-color-1">
                         <div class="dashboard-widget-info">
                            <h1>05</h1>
                            <span>Upcoming Booking</span>
                         </div>
                         <div class="dashboard-widget-icon">
                            <i class="fal fa-list"></i>
                         </div>
                      </div>
                   </div>
                   <div class="col-md-6 col-lg-4">
                      <div class="dashboard-widget dashboard-widget-color-2">
                         <div class="dashboard-widget-info">
                            <h1>1250</h1>
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
                            <h1>110</h1>
                            <span>Cancel Booking</span>
                         </div>
                         <div class="dashboard-widget-icon">
                            <i class="fal fa-xmark-circle"></i>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-lg-12">
                      <div class="user-profile-card">
                         <h4 class="user-profile-card-title">Upcoming Booking</h4>
                         <div class="table-responsive">
                            <table class="table text-nowrap">
                               <thead>
                                  <tr>
                                     <th>Cab Info</th>
                                     <th>Journey Date</th>
                                     <th>Drop Off Location</th>
                                     <th>Price</th>
                                     <th>Status</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr>
                                     <td>
                                        <div class="table-list-info">
                                           <a href="#">
                                              <img src="assets/img/taxi/01.png" alt>
                                              <div class="table-list-content">
                                                 <h6>Mercedes Benz Taxi</h6>
                                                 <span>Booking ID: #123456</span>
                                              </div>
                                           </a>
                                        </div>
                                     </td>
                                     <td>
                                        <span>24 February, 2023</span>
                                        <p>03:15 PM</p>
                                     </td>
                                     <td>
                                        77 Sunshine Strip, Harlingen
                                     </td>
                                     <td>$650</td>
                                     <td><span class="badge badge-primary">Upcoming</span></td>
                                  </tr>
                                  <tr>
                                     <td>
                                        <div class="table-list-info">
                                           <a href="#">
                                              <img src="assets/img/taxi/01.png" alt>
                                              <div class="table-list-content">
                                                 <h6>Mercedes Benz Taxi</h6>
                                                 <span>Booking ID: #123456</span>
                                              </div>
                                           </a>
                                        </div>
                                     </td>
                                     <td>
                                        <span>24 February, 2023</span>
                                        <p>03:15 PM</p>
                                     </td>
                                     <td>
                                        77 Sunshine Strip, Harlingen
                                     </td>
                                     <td>$650</td>
                                     <td><span class="badge badge-primary">Upcoming</span></td>
                                  </tr>
                                  <tr>
                                     <td>
                                        <div class="table-list-info">
                                           <a href="#">
                                              <img src="assets/img/taxi/01.png" alt>
                                              <div class="table-list-content">
                                                 <h6>Mercedes Benz Taxi</h6>
                                                 <span>Booking ID: #123456</span>
                                              </div>
                                           </a>
                                        </div>
                                     </td>
                                     <td>
                                        <span>24 February, 2023</span>
                                        <p>03:15 PM</p>
                                     </td>
                                     <td>
                                        77 Sunshine Strip, Harlingen
                                     </td>
                                     <td>$650</td>
                                     <td><span class="badge badge-primary">Upcoming</span></td>
                                  </tr>
                                  <tr>
                                     <td>
                                        <div class="table-list-info">
                                           <a href="#">
                                              <img src="assets/img/taxi/01.png" alt>
                                              <div class="table-list-content">
                                                 <h6>Mercedes Benz Taxi</h6>
                                                 <span>Booking ID: #123456</span>
                                              </div>
                                           </a>
                                        </div>
                                     </td>
                                     <td>
                                        <span>24 February, 2023</span>
                                        <p>03:15 PM</p>
                                     </td>
                                     <td>
                                        77 Sunshine Strip, Harlingen
                                     </td>
                                     <td>$650</td>
                                     <td><span class="badge badge-primary">Upcoming</span></td>
                                  </tr>
                                  <tr>
                                     <td>
                                        <div class="table-list-info">
                                           <a href="#">
                                              <img src="assets/img/taxi/01.png" alt>
                                              <div class="table-list-content">
                                                 <h6>Mercedes Benz Taxi</h6>
                                                 <span>Booking ID: #123456</span>
                                              </div>
                                           </a>
                                        </div>
                                     </td>
                                     <td>
                                        <span>24 February, 2023</span>
                                        <p>03:15 PM</p>
                                     </td>
                                     <td>
                                        77 Sunshine Strip, Harlingen
                                     </td>
                                     <td>$650</td>
                                     <td><span class="badge badge-primary">Upcoming</span></td>
                                  </tr>
                               </tbody>
                            </table>
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

</script>

@endpush
