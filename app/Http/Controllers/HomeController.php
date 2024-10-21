<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleModels;
use App\Models\VehicleTypes;

class HomeController extends Controller
{
    public function index()
    {
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        return view('pages.frontend.home',compact('allVehicleTypes','allVehicleModels')); // Make sure to create this view (auth/login.blade.php)
    }
}
