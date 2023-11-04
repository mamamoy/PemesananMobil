<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drivers;
use App\Models\Vehicles;
use App\Models\Offices;
use App\Models\OfficeType;
use App\Models\Mines;
use App\DataTables\VehiclesDataTable;
use App\Models\Approval;
use App\Models\LogActivities;
use App\Models\Reservation;

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
        $data = [
            'logs' => LogActivities::all(),
            'drivers' => Drivers::all(),
            'vehicles' => Vehicles::all(),
            'offices' => Offices::all(),
            'mines' => Mines::all(),
            'users' => User::all(),
        ];

        return view('dashboard.index', $data);
    }

    public function getDataVehicles()
    {
        if (request()->ajax()) {
            $vehicles = Vehicles::query();

            return DataTables::of($vehicles)
                ->editColumn('repair', function ($vehicles) {
                    return $vehicles->repair ? 'Available' : 'Need Repair';
                })
                ->editColumn('fuel_consume', function ($vehicles) {
                    return $vehicles->fuel_consume . ' km/L';
                })
                ->make(true);
        }
    }

    public function getDataDrivers()
    {
        if (request()->ajax()) {
            $drivers = Drivers::query();

            return DataTables::of($drivers)
                ->make(true);
        }
    }
}
