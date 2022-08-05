<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $presence = Presence::with('employee')->get();
        return response()->json([
            'status' => 'success',
            'data' => $presence,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'id_employee' => 'required|integer',
            'check_in' => 'time',
            'check_out'=> 'time',
            'date'=> 'date',
            'status'=> 'string',
            'attend' => 'boolean',
        ];
        $validator = Validator::make($request->all(), $rules);

        $presence = Presence::create($request->all());
        return response()->json([
            'status' => 'data updated successuflly',
            'data' => $presence,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $presence = Presence::with('employee')->find($id);
        return response()->json([
            'status' => 'data retrieved successfully',
            'data' => $presence,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'id_employee' => 'required|integer',
            'check_in' => 'time',
            'check_out'=> 'time',
            'date'=> 'date',
            'status'=> 'string',
            'attend' => 'boolean',
        ];
        $validator = Validator::make($request->all(), $rules);

                $rules = [
            'id_employee' => 'required|integer',
            'check_in' => 'time',
            'check_out'=> 'time',
            'date'=> 'date',
            'status'=> 'string',
            'attend' => 'boolean',
        ];
        $validator = Validator::make($request->all(), $rules);

        $presence = Presence::findOrFail($id);
        $presence->update($request->all());
        return response()->json([
            'status' => 'data updated successuflly',
            'data' => $presence,
        ]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $presence = Presence::find($id)->delete();

        return response()->json([
            'status' => 'data deleted successuflly',
            'data' => null,
        ]);
    }
}
