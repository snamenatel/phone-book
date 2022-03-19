<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function login(UserLoginRequest $request)
    {

        $success = Auth::attempt($request->only(['email', 'password']));
        if ($success) {
            return response('', Response::HTTP_OK);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::logout();
        return response('', Response::HTTP_OK);
    }
}
