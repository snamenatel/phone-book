<?php


namespace App\Virtual\Controllers;

/**
 * @OA\Post(
 *     path="/register",
 *     summary="Create new user",
 *     tags={"auth"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/UserCreateRequestSchema")
 *     ),
 *     @OA\Response(
 *        response="200",
 *        description="Success register",
 *        @OA\JsonContent(ref="#/components/schemas/UserSchema")
 *     ),
 *     @OA\Response(
 *        response="422",
 *        description="Wrong register",
 *     )
 * )
 **/
class UserControllerSchema
{
    //
}
