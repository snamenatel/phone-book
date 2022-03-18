<?php


namespace App\Virtual\Requests;

/**
 *  @OA\Schema(
 *      title="UserCreateRequest",
 *      required={"name", "email","password"},
 *      @OA\Property(property="name", type="string", example="Ilya Dudarek"),
 *      @OA\Property(property="email", type="string", format="email", example="test@test.com"),
 *      @OA\Property(property="password", type="string", example="password123"),
 * )
 */
class UserCreateRequestSchema
{
    //
}