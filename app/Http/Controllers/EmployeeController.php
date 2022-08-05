<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee = Employee::with('presences')->get();
        return response()->json([
            'status' => 'success',
            'data' => $employee,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required|string',
            'role'=> 'string',
            'nik'=> 'string',
            'npwp' => 'string',
            'id_company' => 'required|string',
            'started' => 'date',
            'finished'=> 'date',

        ];
        $validator = Validator::make($request->all(), $rules);
       
        $employee = Employee::create($request->all());
        return response()->json([
            'status' => 'data added successfully',
            'data' => $employee,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $employee = Employee::with('presences')->find($id);
        return response()->json([
            'status' => 'data retrieved successfully',
            'data' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name' => 'string',
            'role'=> 'string',
            'nik'=> 'string',
            'npwp' => 'string',
            'id_company' => 'string',
            'started' => 'date',
            'finished'=> 'date',
        ];
        $validator = Validator::make($request->all(), $rules);
        
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return response()->json([
            'status' => 'data updated successuflly',
            'data' => $employee,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $employee = Employee::find($id);
        $presences = Presence::where('id_employee', $employee->id)->get()->all();

        foreach($presences as $presence){
            $presence->delete();
        }
        $employee->delete();

        return response()->json([
            'status' => 'data deleted successuflly',
            'data' => null,
        ]);
    }
}
