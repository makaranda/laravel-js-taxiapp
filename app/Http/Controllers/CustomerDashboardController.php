<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RouteService;

use App\Models\Bookings;
use App\Models\Taxis;
use App\Models\VehicleTypes;
use App\Models\VehicleModels;

class CustomerDashboardController extends Controller
{
    protected $routeService;
    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }
    public function index(){
        $user_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $allUpcommingBooking = Bookings::where('status', 1)->where('user_id', $user_id)->where('pick_up_date',date('Y-m-d'))->whereIn('active', ['pending', 'active'])->count();

        $allTotalBooking = Bookings::where('status', 1)->where('user_id', $user_id)->count();

        $allCancelBooking = Bookings::where('status', 1)->where('user_id', $user_id)->whereIn('active',['cancel'])->count();

        return view('pages.frontend.user_dashboard',compact('allVehicleTypes','allVehicleModels','allUpcommingBooking','allTotalBooking','allCancelBooking'));
    }

    public function customerBooking(){
        $user_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $allUpcommingBooking = Bookings::where('status', 1)->where('user_id', $user_id)->where('pick_up_date',date('Y-m-d'))->whereIn('active', ['pending', 'active'])->count();

        $allTotalBooking = Bookings::where('status', 1)->where('user_id', $user_id)->count();

        $allCancelBooking = Bookings::where('status', 1)->where('user_id', $user_id)->whereIn('active',['cancel'])->count();

        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard_booking',compact('allVehicleTypes','allVehicleModels','allUpcommingBooking','allTotalBooking','allCancelBooking'));
    }

    public function customerCancelBooking(){
        $user_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $allUpcommingBooking = Bookings::where('status', 1)->where('user_id', $user_id)->where('pick_up_date',date('Y-m-d'))->whereIn('active', ['pending', 'active'])->count();

        $allTotalBooking = Bookings::where('status', 1)->where('user_id', $user_id)->count();

        $allCancelBooking = Bookings::where('status', 1)->where('user_id', $user_id)->whereIn('active',['cancel'])->count();

        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard_cancel_booking',compact('allVehicleTypes','allVehicleModels','allUpcommingBooking','allTotalBooking','allCancelBooking'));
    }

    public function customerProfile(){
        $user_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $allUpcommingBooking = Bookings::where('status', 1)->where('user_id', $user_id)->where('pick_up_date',date('Y-m-d'))->whereIn('active', ['pending', 'active'])->count();

        $allTotalBooking = Bookings::where('status', 1)->where('user_id', $user_id)->count();

        $allCancelBooking = Bookings::where('status', 1)->where('user_id', $user_id)->whereIn('active',['cancel'])->count();

        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard_profile',compact('allVehicleTypes','allVehicleModels','allUpcommingBooking','allTotalBooking','allCancelBooking'));
    }

    public function customerUpdatePassword(Request $request)
    {
        // Validate the input data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // confirm_password must match new_password
        ]);

        // Check if the old password matches
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json([
                'messageType' => 'error',
                'message' => 'Old password is incorrect.'
            ]);
        }

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return success response
        return response()->json([
            'messageType' => 'success',
            'message' => 'Password updated successfully!'
        ]);
    }

    public function customerUpdateProfile(Request $request){
        $user = Auth::user();

        // Update user details
        $user->name = $request->user_name;
        $user->gender = $request->user_gender;
        $user->birthday = $request->user_birthday;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->address = $request->user_address;
        $user->save();

        // Return response to the AJAX request
        return response()->json([
            'messageType' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function fetchCancelBooking(Request $request){
        $allPendingBookings = Bookings::where('status', 1)->where('active', 'cancel')->get();
        $fetchTable = '<table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Cab Info</th>
                            <th>Journey Date</th>
                            <th width="150px">Drop Off Location</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($allPendingBookings as $key => $pendingBooking) {

            if($pendingBooking->driver_id){
                $taxis_detail = Taxis::where('status',1)->where('user_id','=',$pendingBooking->driver_id)->first();
                $title = $taxis_detail->title;
                $taxi_img = isset($taxis_detail->image) ? $taxis_detail->image : 'taxi_sample.png';
            }else{
                $title = '';
                $taxi_img = 'taxi_sample.png';
            }


            $booking_id = $pendingBooking->id;

            $time = $pendingBooking->pick_up_date;
            $pickupTime = date("h:i A", strtotime($time));
            $date = $pendingBooking->pick_up_date;
            $pickupDate = date("d F, Y", strtotime($date));


            list($latitude, $longitude) = explode(',', $pendingBooking->pick_up_location);
            $address = '';
            $address = $this->routeService->reverseGeocode($latitude, $longitude);

            $fetchTable .='<tr>
                            <td>'. ($key + 1) .'</td>
                                <td width="150px">
                                <div class="table-list-info">
                                <a href="#">
                                    <img src="'.url('public/assets/img/taxi/'.$taxi_img.'').'" alt>
                                    <div class="table-list-content">
                                        <h6>'.$title.'</h6>
                                        <span>Booking ID: #'.$pendingBooking->id.'</span>
                                    </div>
                                </a>
                                </div>
                            </td>
                            <td>
                            <span>'.$pickupDate.'</span>
                            <p>'.$pickupTime.'</p>
                            </td>
                            <td width="150px">
                                '.$address.'
                            </td>
                            <td>Rs '.$pendingBooking->total_charged.'</td>
                            <td><span class="badge badge-danger text-capitalize">'.$pendingBooking->active.'</span></td>
                            </tr>';

        }

        $fetchTable .= '</tbody>
                    </table>';
        echo $fetchTable ;
    }

    public function fetchCustomerBooking(Request $request){
        $allPendingBookings = Bookings::where('status', 1)->where('active', 'complete')->get();
        $fetchTable = '<table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Cab Info</th>
                            <th>Journey Date</th>
                            <th width="150px">Drop Off Location</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($allPendingBookings as $key => $pendingBooking) {

            if($pendingBooking->driver_id){
                $taxis_detail = Taxis::where('status',1)->where('user_id','=',$pendingBooking->driver_id)->first();
                $title = $taxis_detail->title;
                $taxi_img = isset($taxis_detail->image) ? $taxis_detail->image : 'taxi_sample.png';
            }else{
                $title = '';
                $taxi_img = 'taxi_sample.png';
            }


            $booking_id = $pendingBooking->id;

            $time = $pendingBooking->pick_up_date;
            $pickupTime = date("h:i A", strtotime($time));
            $date = $pendingBooking->pick_up_date;
            $pickupDate = date("d F, Y", strtotime($date));


            list($latitude, $longitude) = explode(',', $pendingBooking->pick_up_location);
            $address = '';
            $address = $this->routeService->reverseGeocode($latitude, $longitude);

            $fetchTable .='<tr>
                            <td>'. ($key + 1) .'</td>
                                <td width="150px">
                                <div class="table-list-info">
                                <a href="#">
                                    <img src="'.url('public/assets/img/taxi/'.$taxi_img.'').'" alt>
                                    <div class="table-list-content">
                                        <h6>'.$title.'</h6>
                                        <span>Booking ID: #'.$pendingBooking->id.'</span>
                                    </div>
                                </a>
                                </div>
                            </td>
                            <td>
                            <span>'.$pickupDate.'</span>
                            <p>'.$pickupTime.'</p>
                            </td>
                            <td width="150px">
                                '.$address.'
                            </td>
                            <td>Rs '.$pendingBooking->total_charged.'</td>
                            <td><span class="badge badge-success text-capitalize">'.$pendingBooking->active.'</span></td>
                            </tr>';

        }

        $fetchTable .= '</tbody>
                    </table>';
        echo $fetchTable ;
    }

    public function fetchPedingBooking(Request $request){
        $allPendingBookings = Bookings::where('status', 1)->where('active', 'pending')->get();
        $fetchTable = '<table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Cab Info</th>
                            <th>Journey Date</th>
                            <th width="150px">Drop Off Location</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($allPendingBookings as $key => $pendingBooking) {

            if($pendingBooking->driver_id){
                $taxis_detail = Taxis::where('status',1)->where('user_id','=',$pendingBooking->driver_id)->first();
                $title = $taxis_detail->title;
                $taxi_img = isset($taxis_detail->image) ? $taxis_detail->image : 'taxi_sample.png';
            }else{
                $title = '';
                $taxi_img = 'taxi_sample.png';
            }


            $booking_id = $pendingBooking->id;

            $time = $pendingBooking->pick_up_date;
            $pickupTime = date("h:i A", strtotime($time));
            $date = $pendingBooking->pick_up_date;
            $pickupDate = date("d F, Y", strtotime($date));


            list($latitude, $longitude) = explode(',', $pendingBooking->pick_up_location);
            $address = '';
            $address = $this->routeService->reverseGeocode($latitude, $longitude);

            $fetchTable .='<tr>
                            <td>'. ($key + 1) .'</td>
                                <td width="150px">
                                <div class="table-list-info">
                                <a href="#">
                                    <img src="'.url('public/assets/img/taxi/'.$taxi_img.'').'" alt>
                                    <div class="table-list-content">
                                        <h6>'.$title.'</h6>
                                        <span>Booking ID: #'.$pendingBooking->id.'</span>
                                    </div>
                                </a>
                                </div>
                            </td>
                            <td>
                            <span>'.$pickupDate.'</span>
                            <p>'.$pickupTime.'</p>
                            </td>
                            <td width="150px">
                                '.$address.'
                            </td>
                            <td>Rs '.$pendingBooking->total_charged.'</td>
                            <td><span class="badge badge-primary text-capitalize">'.$pendingBooking->active.'</span></td>
                            </tr>';

        }

        $fetchTable .= '</tbody>
                    </table>';
        echo $fetchTable ;
        // $responseData = [
        //     'pending_booking' => $fetchTable,
        // ];
        //return response()->json($responseData);
    }
}
