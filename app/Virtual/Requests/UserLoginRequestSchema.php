<?php


namespace App\Virtual\Requests;

/**
 *  @OA\Schema(
 *      title="UserLoginRequest",
 *      required={"email","password"},
 *      @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
 *      @OA\Property(property="password", type="string", example="password"),
 * )
 */
class UserLoginRequestSchema
{
    //
}
