<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 400, 'message' => 'bad Request']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'status_code' => 200,
            'message' => 'user created succesfuly',
            'token' => $user->createToken($request->name)->plainTextToken
        ]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status_code' => 400, 'message' => 'bad Request']);
        }
        $credential = request(['email', 'password']);
        if (!Auth::attempt($credential)) {
            return response()->json(['status_code' => 500, 'message' => 'nonauthoized']);
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status_code' => 200, 'token' => $tokenResult,
            'id' => $user->id, 'name' => $user->name, 'is_admin' => $user->is_admin
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'data' => $request->user(), 
            'message' => 'token deleted succesfuly'],200);
    }
}
