<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $valid = Validator::make($request->all(), ['email' => 'required|email', 'password' => 'required|string']);

        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid'], 400);
        }

        $user = User::where('email', $request->input('email'))
            ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unrecognized'], 400);
        }

        $token = $user->createToken('wsd-admin')->plainTextToken;

        return ['token' => $token];
    }
}
