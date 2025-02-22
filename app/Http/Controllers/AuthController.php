<?php

namespace App\Http\Controllers;

use App\Actions\Api\User\LoginAction;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
