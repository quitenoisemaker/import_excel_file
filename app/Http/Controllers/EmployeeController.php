<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Imports\EmployeesImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{

    public function getRecords()
    {

        $EmployeeRecords = Employee::getEmployeeRecords();

        return response()->json([
            'status' => 'success',
            'data' => $EmployeeRecords
        ], 200);
    }

    public function importRecord(RecordRequest $request)
    {
        try {
            $csvFile = $request->file('csvFile');
            Excel::import(new EmployeesImport, $csvFile);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Operation successful.'
        ], 201);
    }
}
