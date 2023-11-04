<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Reservation;
use App\Models\Drivers;
use App\Models\LogActivities;
use App\Models\Vehicles;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'reservation' => Reservation::with(['user', 'vehicle', 'driver'])->get(),
        ];

        return view('reservation.index', $data);
    }

    public function getDataReservation()
    {
        if (request()->ajax()) {
            $reservation = Reservation::with(['user', 'vehicle', 'driver'])->get();

            return DataTables::of($reservation)
                ->editColumn('user_id', function ($reservation) {
                    return $reservation->user->name;
                })
                ->editColumn('vehicle_id', function ($reservation) {
                    return $reservation->vehicle->vehicle_name;
                })
                ->editColumn('driver_id', function ($reservation) {
                    return $reservation->driver->driver_name;
                })
                ->make(True);
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'drivers' => Drivers::all(),
            'vehicles' => Vehicles::all(),
        ];


        return view('reservation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'approval' => 0,
        ]);

        $log = LogActivities::create([
            'user_id' => $request->user_id,
            'activity' => 'Reservation',
        ]);


        if ($reservation && $log) {
            return redirect()->route('reservation.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('reservation.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserves  $reserves
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reserves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserves  $reserves
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reserves)
    {
        //
    }

    public function exportExcel(Request $request){

        $reservation = Reservation::with(['user', 'driver', 'vehicle'])->get();
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Name Applicant');
        $sheet->setCellValue('D1', 'Vehicle Name');
        $sheet->setCellValue('E1', 'Driver Name');
        $sheet->setCellValue('F1', 'Start Date');
        $sheet->setCellValue('G1', 'End Date');

        $row=2;
        foreach ($reservation as $num => $value) {
            $sheet->setCellValue('A' . $row, $num+1);
            $sheet->setCellValue('B' . $row, $value->created_at);
            $sheet->setCellValue('C' . $row, $value->user->name);
            $sheet->setCellValue('D' . $row, $value->driver->driver_name);
            $sheet->setCellValue('E' . $row, $value->start_date);
            $sheet->setCellValue('F' . $row, $value->end_date);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ReservationData.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservesRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
