<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactSearchRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(ContactSearchRequest $request): JsonResponse
    {
        return response()->json(
            ContactResource::collection($this->repository->search($request))
        );
    }

    public function create()
    {
        //
    }

    public function store(ContactStoreRequest $request): ContactResource
    {
        return $this->repository->store($request);
    }


    public function show(int $id): JsonResponse
    {
        return response()->json(
            ContactResource::make($this->repository->show($id))
        );
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->repository->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
