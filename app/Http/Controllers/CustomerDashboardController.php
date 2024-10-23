<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\VehicleTypes;
use App\Models\VehicleModels;

class CustomerDashboardController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $allUpcommingBooking = Bookings::where('status', 1)->where('user_id', $user_id)->where('pick_up_date',date('Y-m-d'))->whereIn('active', ['pending', 'active'])->count();

        $allTotalBooking = Bookings::where('status', 1)->where('user_id', $user_id)->count();

        $allCancelBooking = Bookings::where('status', 1)->where('user_id', $user_id)->whereIn('active',['cancel'])->count();

        return view('pages.frontend.user_dashboard',compact('allVehicleTypes','allVehicleModels','allUpcommingBooking','allTotalBooking','allCancelBooking'));
    }

    public function customerProfile(){
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard_profile',compact('allVehicleTypes','allVehicleModels'));
    }
}
