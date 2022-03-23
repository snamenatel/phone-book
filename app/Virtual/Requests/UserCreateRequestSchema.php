<?php


namespace App\Virtual\Requests;

/**
 *  @OA\Schema(
 *      title="UserCreateRequest",
 *      required={"name", "email","password"},
 *      @OA\Property(property="name", type="string", example="Ivan Ivanov"),
 *      @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
 *      @OA\Property(property="password", type="string", example="password"),
 * )
 */
class UserCreateRequestSchema
{
    //
}
