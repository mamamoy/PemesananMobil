<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\LogActivities;
use App\Models\Reservation;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use DataTables;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ApprovingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'approval' => Approval::all(),
        ];

        return view('approval.index', $data);
    }

    public function getDataApproval()
    {
        if (request()->ajax()) {
            $approvals = Approval::with(['user', 'reservation'])->get();

            return DataTables::of($approvals)
                ->editColumn('user_approve_id', function ($approval) {
                    return $approval->user->name;
                })->editColumn('created_at', function ($approval) {
                    return $approval->created_at->format('Y-m-d H:i:s');
                })
                ->make(True);
        };
    }

    public function exportExcel(Request $request){

        $approvals = Approval::with(['user', 'reservation'])->get();
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Date Applicant');
        $sheet->setCellValue('C1', 'Name Applicant');
        $sheet->setCellValue('D1', 'Vehicle Name');
        $sheet->setCellValue('E1', 'Driver Name');
        $sheet->setCellValue('F1', 'Start Date');
        $sheet->setCellValue('G1', 'End Date');
        $sheet->setCellValue('H1', 'Name Approval');
        $sheet->setCellValue('I1', 'Date Approve');

        $row=2;
        foreach ($approvals as $num => $value) {
            $sheet->setCellValue('A' . $row, $num+1);
            $sheet->setCellValue('B' . $row, $value->reservation->created_at);
            $sheet->setCellValue('C' . $row, $value->reservation->user->name);
            $sheet->setCellValue('D' . $row, $value->reservation->vehicle->vehicle_name);
            $sheet->setCellValue('E' . $row, $value->reservation->driver->driver_name);
            $sheet->setCellValue('F' . $row, $value->reservation->start_date);
            $sheet->setCellValue('G' . $row, $value->reservation->end_date);
            $sheet->setCellValue('I' . $row, $value->reservation->created_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ApprovalData.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'reservation_id' => 'required',
            'user_approve_id' => 'required',
        ]);

        $approve = Approval::create([
            'reservation_id' => $request->reservation_id,
            'user_approve_id' => $request->user_approve_id,
        ]);

        $vehicle = Vehicles::findOrFail($request->vehicle_id);

        $repair = $vehicle->usage_history % 5;

        if ($repair === 0) {
            $vehicle->update([
                'repair' => 1,
            ]);
        }

        $vehicle->update([
            'usage_history' => $vehicle->usage_history + 1,
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        $reservation->update([
            'approval' => 1,
        ]);

        $log = LogActivities::create([
            'user_id' => $request->user_approve_id,
            'activity' => 'Approving',
        ]);

        if ($approve && $vehicle && $log && $reservation) {
            return redirect()->route('approving.index')->with('success', 'Data updated is success!');
        } else {
            return redirect()->route('approving.index')->with('error', 'Data updated is error!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
