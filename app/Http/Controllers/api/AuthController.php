<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'roles_name' => 'required',
        ]);
    
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->all());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_name' => ["$request->roles_name"],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['message' => 'unauthorized'], 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'auth_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'you logout successfully'
        ];
    }

    public function refresh() {
        $user = auth()->user();
        auth()->user()->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token,
        ], 200);

    }

    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
