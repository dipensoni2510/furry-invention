<?php

namespace App\Http\Controllers;

use App\Company;
use App\Feature;
use App\Order;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $companies = Company::count();
        $vehicle = Vehicle::count();

        //Clients
        $orderedVehciles = Order::where('user_id', auth()->user()->id)
            ->count();
        $notReturnedVehicles = Order::where('user_id', auth()->user()->id)
            ->where('status', 'not_return')->count();
        $returnVehicles = Order::where('user_id', auth()->user()->id)
            ->where('status', 'return')->count();

        //Admin
        $totalFeatures = Feature::count();
        $totalOrders = Order::count();
        $totalNotReturnedVehicles = Order::where('status', 'not_return')
            ->count();
        $totalReturnedVehicles = Order::where('status', 'return')
            ->count();
        $totalUserCount = User::where('role', 'client')
            ->count();

        return view(
            'pages.dashboard-analytics',
            (auth()->user()->role === "admin") ? [
                "users" => $totalUserCount, "companies" => $companies, "vehicles" => $vehicle, "orders" => $totalOrders, "featurs" => $totalFeatures, "totalReturnedVehicles" => $totalReturnedVehicles, "totalNotReturnedVehicles" => $totalNotReturnedVehicles
            ] : [
                "ordersByUser" => $orderedVehciles, "companies" => $companies,
                "vehicles" => $vehicle, "notReturnVehicles" => $notReturnedVehicles, "returnVehicle" => $returnVehicles
            ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
