<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RouteService;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Bookings;
use App\Models\VehicleTypes;
use DateTime;

class BookingController extends Controller
{
    protected $routeService;
    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }
    public function frontBooking(Request $request){

        /*
            pickuplocation picup_long picup_lati dropofflocation dropoff_long dropoff_lati
            passengers vehicle_type pick_up_date pick_up_time vehicle_model
        */
        $messageType = '';
        $message = '';
        $inserted_id = 0;

        // Validate the incoming request data
        $rules = [
            'vehicle_type' => 'required',
        ];

        // Add a condition for 'picup_long' or 'nav_picup_long'
        if ($request->bookingFormType == 'front-form') {
            $rules['picup_long'] = 'required';
            $rules['picup_lati'] = 'required';

            $rules['dropoff_long'] = 'required';
            $rules['dropoff_lati'] = 'required';

            $rules['passengers'] = 'required';

            $rules['pick_up_date'] = 'required';
            $rules['pick_up_time'] = 'required';

        } elseif($request->bookingNavFormType == 'navi-form') {
            $rules['nav_picup_long'] = 'required';
            $rules['nav_picup_lati'] = 'required';

            $rules['nav_dropoff_long'] = 'required';
            $rules['nav_dropoff_lati'] = 'required';

            $rules['navpassengers'] = 'required';

            $rules['nav_pick_up_date'] = 'required';
            $rules['nav_pick_up_time'] = 'required';
        }

        // Now pass the rules to the validator
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messageType = 'error';
            //$message = $validator->errors();
            $message = $validator->errors()->all();
            $message = implode(', ', $message);
            //$message = 'All Fields are Required..!!';
        }else{
            if (Auth::check()) {
                //` user_id`, `driver_id`, `pick_up_location`, `drop_off_location`, `active`, `status`, `created_at`, `updated_at`

                // Fallback to nav form data if front form data is not present
                $pick_up_time = $request->pick_up_time ?? $request->nav_pick_up_time;
                $pick_up_date = $request->pick_up_date ?? $request->nav_pick_up_date;
                $passengers = $request->passengers ?? $request->navpassengers;

                // Format the time correctly if valid
                if ($pick_up_time) {
                    $dateTime = DateTime::createFromFormat('h:i A', $pick_up_time);
                    $formattedTime = $dateTime ? $dateTime->format('H:i:s') : null;
                } else {
                    $formattedTime = null; // Default to null if time is not provided
                }

                // Handle pickup location, making sure both lat and long are present
                if (isset($request->picup_lati, $request->picup_long)) {
                    $pick_up_location = $request->picup_lati . ',' . $request->picup_long;
                } else {
                    $pick_up_location = $request->nav_picup_lati . ',' . $request->nav_picup_long;
                }

                // Handle dropoff location, making sure both lat and long are present
                if (isset($request->dropoff_lati, $request->dropoff_long)) {
                    $drop_off_location = $request->dropoff_lati . ',' . $request->dropoff_long;
                } else {
                    $drop_off_location = $request->nav_dropoff_lati . ',' . $request->nav_dropoff_long;
                }

                // Prepare the data array
                $proData = [
                    'user_id' => Auth::user()->id,
                    'driver_id' => null,  // Assuming no driver is assigned yet
                    'pick_up_location' => $pick_up_location,
                    'drop_off_location' => $drop_off_location,
                    'passengers' => $passengers,
                    'vehicle_type' => $request->vehicle_type,
                    'pick_up_date' => $pick_up_date,
                    'pick_up_time' => $formattedTime,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                function boldUnicode($text) {
                    $bold_map = [
                        'a' => '𝗮', 'b' => '𝗯', 'c' => '𝗰', 'd' => '𝗱', 'e' => '𝗲', 'f' => '𝗳', 'g' => '𝗴', 'h' => '𝗵', 'i' => '𝗶', 'j' => '𝗷', 'k' => '𝗸', 'l' => '𝗹', 'm' => '𝗺', 'n' => '𝗻', 'o' => '𝗼', 'p' => '𝗽', 'q' => '𝗾', 'r' => '𝗿', 's' => '𝘀', 't' => '𝘁', 'u' => '𝘂', 'v' => '𝘃', 'w' => '𝘄', 'x' => '𝘅', 'y' => '𝘆', 'z' => '𝘇',
                        'A' => '𝗔', 'B' => '𝗕', 'C' => '𝗖', 'D' => '𝗗', 'E' => '𝗘', 'F' => '𝗙', 'G' => '𝗚', 'H' => '𝗛', 'I' => '𝗜', 'J' => '𝗝', 'K' => '𝗞', 'L' => '𝗟', 'M' => '𝗠', 'N' => '𝗡', 'O' => '𝗢', 'P' => '𝗣', 'Q' => '𝗤', 'R' => '𝗥', 'S' => '𝗦', 'T' => '𝗧', 'U' => '𝗨', 'V' => '𝗩', 'W' => '𝗪', 'X' => '𝗫', 'Y' => '𝗬', 'Z' => '𝗭',
                        '0' => '𝟬', '1' => '𝟭', '2' => '𝟮', '3' => '𝟯', '4' => '𝟰', '5' => '𝟱', '6' => '𝟲', '7' => '𝟳', '8' => '𝟴', '9' => '𝟵'
                    ];
                    return strtr($text, $bold_map);
                }

                $phone = Auth::user()->phone;
                $name = Auth::user()->name;

                $message = "Dear $name,\nYou have already booked the taxi and driver will be connect with you,\nCheers,\nEsoft Taxi Team";

                //$message = "Dear $name,\nPlease use the following OTP to verify your account \nOTP Number : $otp\nCheers,\nEsoft Taxi Team";

                // Send the request to the SMS API
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer 2287|gbVI7WdVoG69zUFAV4cxCDddN0HsTUgiwgC86QvG',
                ])->post('https://sms.send.lk/api/v3/sms/send', [
                    'recipient' => $phone,
                    'sender_id' => 'SendTest', // Use your actual sender ID
                    'message' => $message,
                ]);

                if ($response->successful()) {
                    $addDatas = new Bookings();
                    // Save the data
                    $addDatas->fill($proData);
                    $addDatas->save();
                    $insertedId = $addDatas->id;

                    $messageType = 'success';
                    $message = 'You have successfully Added the Booking successfully..!!';
                    $inserted_id = $insertedId;
                    session(['booking_id' => $insertedId]);
                }else{
                    $messageType = 'error';
                    $message = 'Your Phone Number is Not Verified Please Try again..!!';
                    $inserted_id = 0;
                }


            } else {
                $messageType = 'error';
                $message = 'You are not login to here, before you submit this booking you must login to this system..!!';
                $inserted_id = 0;
                session()->forget('booking_id');
            }
        }
        //$allVehicleTypes = VehicleTypes::where('status', 1)->get();

        $responseData = [
            'message' => $message,
            'messageType' => $messageType,
            'booking_id' => $inserted_id,
        ];

        // Return the JSON response
        return response()->json($responseData);
    }

    public function frontLoginUser(Request $request)
    {
        $message = '';
        $messageType = '';
        // Check if the user is already authenticated
        if (Auth::check()) {
            $status = 1;
            $messageType = 'success';
            $message = 'You are already logged in.';
        } else {
            // Validate the login request
            $validator = Validator::make($request->all(), [
                'login_username' => 'required',
                'login_password' => 'required',
            ]);

            if ($validator->fails()) {
                $status = 0;
                $messageType = 'error';
                $message = implode(', ', $validator->errors()->all());
            } else {
                // Determine if the login_username is email or phone
                $loginField = filter_var($request->login_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

                // Prepare the credentials array
                $credentials = [
                    $loginField => $request->login_username,
                    'password' => $request->login_password,
                ];

                // Attempt to log the user in
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    // Check the user's role
                    if (in_array($user->role, ['customer', 'admin', 'staff'])) {
                        $status = 1;
                        $messageType = 'success';
                        $message = 'Login successful.';

                    } else {
                        // If the role doesn't match, log the user out and return an error
                        Auth::logout();
                        $status = 0;
                        $messageType = 'error';
                        $message = 'You do not have access to this system.';
                    }
                } else {
                    // Invalid credentials
                    $status = 0;
                    $messageType = 'error';
                    $message = 'Invalid username or password.';
                }
            }
        }

        // Prepare the response data
        $responseData = [
            'message' => $message,
            'messageType' => $messageType,
            'status' => $status,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    }

    public function frontGetRoute(Request $request)
    {
        $validated = $request->validate([
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
            'end_lat'   => 'required|numeric',
            'end_lng'   => 'required|numeric',
        ]);

        $start = ['lat' => $validated['start_lat'], 'lng' => $validated['start_lng']];
        $end = ['lat' => $validated['end_lat'], 'lng' => $validated['end_lng']];

        $route = $this->routeService->getRoute($start, $end);

        return response()->json($route);
    }

    public function bookingCancel(Request $request){
        $check_today = date('Y-m-d');
        $checkAllBookings = Bookings::where('status', 1)
                                ->whereIn('active', ['pending', 'active'])
                                ->where('pick_up_date','<', $check_today )
                                ->get();
        foreach($checkAllBookings as $key => $bookingVal){
            $bookingVal->active = 'cancel';
            $bookingVal->save();
        }
    }

    public function updatePriceDistance(Request $request){
        //distancemeeter distancekm map_booking_id
        $distancemeeter = $request->distancekm;
        $distancekm = $request->distancekm;
        $totalCharged = 0;
        $map_booking_id = $request->map_booking_id ?? session('booking_id');
        if (Auth::check()) {
            $checkBookings = Bookings::where('status', 1)
                                    ->where('id',$map_booking_id)
                                    ->whereIn('active', ['pending', 'active'])
                                    ->where('pick_up_date', date('Y-m-d'))
                                    ->first();
            $vehicle_id = $checkBookings->vehicle_type;
            $allVehicleTypes = VehicleTypes::where('status', 1)->where('id',$vehicle_id)->first();
            $cost_perkm = $allVehicleTypes->perkm_charge;
            $totalCharged = $cost_perkm * $distancekm;
            Bookings::where('status', 1)
                    ->where('id',$map_booking_id)
                    ->update([
                        'total_charged' => $totalCharged,
                        'total_km' => $distancekm
                    ]);
            $responseData = [
                'distancekm' => $distancekm,
                'totalCharged' => $totalCharged,
            ];
        }else{
            $responseData = [
                'distancekm' => $distancekm,
                'totalCharged' => $totalCharged,
            ];
        }
        return response()->json($responseData);
    }

    public function frontCheckBooking(Request $request){
        $message = '';
        $messageType = '';
        $booking = 0;
        $status = 0;
        $pick_up_location = '';
        $drop_off_location = '';
        $map_booking_id = $request->map_booking_id ?? session('booking_id');

        if (Auth::check()) {
            $status = 1;

            if(!empty($map_booking_id)){
                $checkBookings = Bookings::where('status', 1)
                                    ->where('id',$map_booking_id)
                                    ->whereIn('active', ['pending', 'active'])
                                    ->where('pick_up_date', date('Y-m-d'))
                                    ->first();
            }else{
                $checkBookings = Bookings::where('status', 1)
                                    ->whereIn('active', ['pending', 'active'])
                                    ->where('pick_up_date', date('Y-m-d'))
                                    ->first();
            }

            if ($checkBookings) {
                $booking = 1;
                $pick_up_location = $checkBookings->pick_up_location;
                $drop_off_location = $checkBookings->drop_off_location;

            } else {
                $booking = 0;
                $pick_up_location = '';
                $drop_off_location = '';
            }
        } else {
            $status = 0;
        }

        $responseData = [
            'message' => $message,
            'messageType' => $messageType,
            'status' => $status,
            'booking' => $booking,
            'pick_up_location' => $pick_up_location,
            'drop_off_location' => $drop_off_location,
            'customer_name' => Auth::user()->name,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    }

    public function frontCheckUser(Request $request){
        $status = Auth::check() ? 1 : 0;
        return response()->json(['status' => $status]);
    }
}
