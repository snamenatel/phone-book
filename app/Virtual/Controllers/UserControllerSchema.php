<?php


namespace App\Virtual\Controllers;

/**
 *
 * @OA\Post(
 *     path="/register",
 *     summary="Create new user",
 *     tags={"auth"},
 *     security={},
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
 *
 * @OA\Post(
 *     path="/login",
 *     summary="Login user",
 *     tags={"auth"},
 *     security={},
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/UserLoginRequestSchema")
 *     ),
 *     @OA\Response(
 *        response="200",
 *        description="Success login",
 *            @OA\JsonContent(
 *                @OA\Property(property="token", type="string")
 *            )
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Wrong login",
 *     )
 * )
 *
 * @OA\Post(
 *     path="/logout",
 *     summary="Logout user",
 *     tags={"auth"},
 *     security={{"sanctum": {}}},
 *     @OA\Response(
 *        response="200",
 *        description="Success logout",
 *     ),
 * )
 *
 * @OA\Post(
 *     path="/password_reset",
 *     summary="Forget password",
 *     tags={"auth"},
 *     security={},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              @OA\Property(property="email", type="email", format="email", example="test@test.com")
 *          )
 *     ),
 *     @OA\Response(
 *        response="200",
 *        description="Sended email with token",
 *     ),
 * )
 *
 *  @OA\Get (
 *     path="/password_reset",
 *     summary="Get resest password token",
 *     tags={"auth"},
 *     security={},
 *     @OA\Parameter(name="email", example="test@test.com", in="query"),
 *     @OA\Parameter(name="token", example="token", in="query"),
 *     @OA\Response(
 *        response="200",
 *        description="Sended email with token",
 *     ),
 * )
 *
 * @OA\Patch (
 *     path="/password_reset",
 *     summary="Update password",
 *     tags={"auth"},
 *     security={},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              @OA\Property(property="email", type="string", format="email", example="test@test.com"),
 *              @OA\Property(property="password", type="string", format="password", example="password"),
 *              @OA\Property(property="password_confirmation", type="string", format="password", example="password"),
 *              @OA\Property(property="token", type="string", example="token")
 *          )
 *     ),
 *     @OA\Response(
 *        response="200",
 *        description="Sended email with token",
 *     ),
 *     @OA\Response(
 *        response="422",
 *        description="Failed validation",
 *     ),
 * )
 *
 * @OA\Get(
 *     path="/user",
 *     summary="Get auth user data",
 *     tags={"auth"},
 *     security={{"sanctum": {}}},
 *     @OA\Response (
 *         response="200",
 *         description="Succes",
 *         @OA\JsonContent(ref="#/components/schemas/UserSchema")
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Unauthorized",
 *     )
 * )
 *
 **/
class UserControllerSchema
{
    //
}
