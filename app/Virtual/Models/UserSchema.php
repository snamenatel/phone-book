<?php


namespace App\Virtual\Models;

/**
 *  @OA\Schema(
 *      title="User",
 *      @OA\Property(property="id", type="integer", example="1"),
 *      @OA\Property(property="name", type="string", example="Ilya Dudarek"),
 *      @OA\Property(property="email", type="string", format="email", example="test@test.com"),
 *      @OA\Property(property="email_verified_at", type="string", format="date-time", example="2022-03-18 12:59:20"),
 *      @OA\Property(property="password", type="string", format="password"),
 *      @OA\Property(property="remember_token", type="string"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2022-03-18 12:59:20")),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2022-03-18 12:59:20")),
 * )
 */
class UserSchema
{
    //
}