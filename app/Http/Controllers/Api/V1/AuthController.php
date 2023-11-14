<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'error' => 'Invalid credentials.'
            ], 402);
        }

        $token = $user->createToken('api');

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token->plainTextToken,
        ];
        return response()->json($response, 200);
    }
}
