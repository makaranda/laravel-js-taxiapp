<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\VehicleTypes;
use App\Models\VehicleModels;

class CustomerDashboardController extends Controller
{
    public function index(){
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard',compact('allVehicleTypes','allVehicleModels'));
    }

    public function customerProfile(){
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();
        return view('pages.frontend.user_dashboard_profile',compact('allVehicleTypes','allVehicleModels'));
    }
}
