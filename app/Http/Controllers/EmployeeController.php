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
        $employee = Employee::with('presences', 'user')->get();
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
       
        DB::beginTransaction();


        try{
        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="employee";
        $user->save();
        
            $emp = new Employee();
            $emp->id_user=$user->id;
            $emp->position = $request->position;
            $emp->nik = $request->nik;
            $emp->npwp = $request->npwp;
            $emp->id_company = $request->id_company;
            $emp->started = $request->started;
            $emp->finished = $request->finished;
            $emp->save();
                  
            
            DB::commit();
            return response()->json([
                'status' => 'data added successfully',
                'data' => $employee,
            ]);
        
        }catch(\Exception $e){
        DB::rollback();
        return response()->json([
            'status' => 'data added unsuccess'
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $employee = Employee::with('presences','user')->find($id);
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
        $user = User::where('id', $employee->id_user)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => "employee",
        ]);
        if($user){
            $employee = $employee->update([
            'nik' => $request->nik,
            'position' => $request->position,
            'npwp' => $request->npwp,
            'id_company' => $request->id_company,
            'started' => $request->started,
            'finished' => $request->finished,

            ]);
            return response()->json([
                'status' => 'data updated successfully',
                'data' => $employee,
            ]);
        }
        
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
        $user = User::where('id_user', $employee->id_user)->get()->all();
        $presences = Presence::where('id_employee', $employee->id)->get()->all();

        foreach($presences as $presence){
            $presence->delete();
        }
        $employee->delete();
        $user->delete();

        return response()->json([
            'status' => 'data deleted successuflly',
            'data' => null,
        ]);
    }
}
