<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;
use App\Support\ApiValidator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(UserCreateRequest $request): JsonResponse
    {
        $user = $this->repository->create($request->toArray());
        return response()->json($user);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $success = Auth::attempt($request->only(['email', 'password']));
        if ($success) {
            return response()->json(['token' => Auth::user()->createToken('API')->plainTextToken], Response::HTTP_OK);
        }
        return response()->json('', Response::HTTP_UNAUTHORIZED);
    }

    public function logout(): Response
    {
        Auth::user()->tokens()->delete();
        Auth::logout();
        return response('', Response::HTTP_OK);
    }

    public function passwordForget(Request $request): Response
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validator->fails()) {
            return response($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Password::sendResetLink($request->only('email'));
        return response('', Response::HTTP_OK);

    }

    public function passwordResetShow(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email', 'token' => 'required|string']);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json($request->only(['email', 'token']));
    }

    public function passwordUpdate(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);
        if ($validator->fails()) {
            return response($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])
                    ->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response('Password changed successfully', Response::HTTP_OK)
            : response('Password changed wrong', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function show(): JsonResponse
    {
        return response()->json(Auth::user());
    }

}
