<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ])->status(404);
        }
        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');
        return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
    }
}
