<?php


namespace App\Virtual\Resources;

/**
 *  @OA\Schema(
 *      title="ContactResource",
 *      @OA\Property(property="id", type="integer", example="1"),
 *      @OA\Property(property="name", type="string", example="Ilya Dudarek"),
 *      @OA\Property(property="author", type="string", example="Ivanov Ivan"),
 *      @OA\Property(property="created_at", type="string", example="18.03.2022"),
 *      @OA\Property(property="phones",
 *         type="array",
 *         example={ "8 (958) 035-63-80", "8 (935) 691-07-52" },
 *         @OA\Items(type="string")
 *     )
 * )
 */
class ContactResourceSchema
{
    //
}
