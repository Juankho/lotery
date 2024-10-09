<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param StoreUserRequest $request
     *
     * @unauthenticated
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $user['token'] = $user->createToken($request->device_name ?? 'auth_api')->plainTextToken;

        // event(new Registered($user));

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => new UserResource($user),
        ], Response::HTTP_CREATED);
    }

    /**
     * Authenticate the user.
     *
     * @unauthenticated
     */
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user['token'] = $user->createToken($request->device_name ?? 'auth_api')->plainTextToken;

        $user->load('role');

        return new UserResource($user);
    }


    /**
     * Get the authenticated user.
     */
    public function user(Request $request)
    {
        return new UserResource($request->user()->load('role'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }


    /**
     * Log the user out from all devices (Invalidate all tokens).
     *
     * This method will delete all tokens associated with the user.
     *
     * @return \Illuminate\Http\Response
     */

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }


    /**
     * Verify the email address of the user.
     *
     * @param EmailVerificationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return response()->json(['message' => 'Email verified successfully']);
    }


    /**
     * Send email verification notification.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmailVerificationNotification(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'Verification link sent!']);
    }
}
