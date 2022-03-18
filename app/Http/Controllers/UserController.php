<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

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

}
