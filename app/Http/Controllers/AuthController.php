<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=> 'register successful',
            'data' => $user,
            'access_token' => $token, 
            'token_type' => 'Bearer', 
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // $request -> session()->regenerate();

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'login successful',
            'data' => $user,
            'access_token' => $token, 
            'token_type' => 'Bearer', 
        ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        // $request -> session()->invalidate();
        // $request -> session()->regenerateToken();

        return [
            'status' => 'successfully logged out and the token was successfully deleted',
            'data'=> null,
        ];
    }

    public function user(Request $request)
    {
        $user = $request->user();
        
        return [
            'status' => 'get user',
            'data'=> $user,
        ];
        // $token = auth()->user()->tokens()->get();

        // $user = User::where('')
        // return [
        //     'status' => 'successfully logged out and the token was successfully deleted',
        //     'data'=> $user,
        // ];
    }
}
