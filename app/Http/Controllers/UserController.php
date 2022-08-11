<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::with('presences')->get();
        return response()->json([
            'status' => 'success',
            'data' => $user,
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
       
        $user = User::create($request->all());
        return response()->json([
            'status' => 'data added successfully',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = User::with('presences')->find($id);
        return response()->json([
            'status' => 'data retrieved successfully',
            'data' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
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
        
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'status' => 'data updated successuflly',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::find($id);
        $presences = Presence::where('id_user', $user->id)->get()->all();

        foreach($presences as $presence){
            $presence->delete();
        }
        $user->delete();

        return response()->json([
            'status' => 'data deleted successuflly',
            'data' => null,
        ]);
    }
}
