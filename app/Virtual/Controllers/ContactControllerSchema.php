<?php


namespace App\Virtual\Controllers;

/**
 *  @OA\Get (
 *     path="/contacts",
 *     summary="Get list of contacts",
 *     tags={"contacts"},
 *     security={{"sanctum": {}}},
 *     @OA\Parameter(name="email", example="test@test.com", in="query"),
 *     @OA\Parameter(name="token", example="token", in="query"),
 *     @OA\Response (
 *         response="200",
 *         description="Succes",
 *         @OA\JsonContent(ref="#/components/schemas/ContactResourceSchema")
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Unauthorized",
 *     )
 * )
 */
class ContactControllerSchema
{
 //
}
