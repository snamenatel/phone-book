<?php


namespace App\Virtual\Requests;

/**
 *  @OA\Schema(
 *      title="UserLoginRequest",
 *      required={"email","password"},
 *      @OA\Property(property="email", type="string", format="email", example="test@test.com"),
 *      @OA\Property(property="password", type="string", example="password123"),
 * )
 */
class UserLoginRequestSchema
{
    //
}
