<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\RouteService;

use Illuminate\Support\Facades\Session;

use App\Models\Bookings;
use App\Models\Reservation;
use App\Models\Payments;
use App\Models\Taxis;
use App\Models\VehicleTypes;
use App\Models\VehicleModels;

class AdminDashboardController extends Controller
{
    protected $routeService;
    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }
    public function index(){
        $admin_id = Auth::user()->id;
        $allVehicleTypes = VehicleTypes::where('status', 1)->get();
        $allVehicleModels = VehicleModels::where('status', 1)->get();

        $getAllBookings = Bookings::where('status', 1)->get();

        return view('pages.app.admin_dashboard',compact('allVehicleTypes','allVehicleModels','getAllBookings'));
    }
}
