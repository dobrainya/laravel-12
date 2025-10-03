<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string'],
        ]);

        /** @var User $user */
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => ['An account successfully created'],
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Provided credentials are incorrect'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken(name: 'auth_token', expiresAt: now()->add('15 minutes'))->plainTextToken,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        /** @var User|null $user */
        if (null === ($user = $request->user())) {
            throw new UnauthorizedException();
        }

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You successfully signed out',
        ]);
    }
}
