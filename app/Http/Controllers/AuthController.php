<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Авторизация",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         example="test@example.com",
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         example="password",
     *     ),
     *     @OA\Response(response="200", description="Login successful", @OA\JsonContent(
     *         ref="#/components/schemas/AuthResponseSchema"
     *     )),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */

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
        return response()->json(['token' => $token->plainTextToken]);
    }
}
