<?php


namespace App\Virtual\Controllers;

/**
 *  @OA\Get (
 *     path="/contacts",
 *     summary="Get list of contacts",
 *     tags={"contacts"},
 *     security={{"sanctum": {}}},
 *     @OA\Parameter(name="name", example="Admin", in="query"),
 *     @OA\Parameter(name="phone", example="79232528636", in="query"),
 *     @OA\Parameter(name="author", example="Ivanov", in="query"),
 *     @OA\Parameter(name="my", example="1", in="query"),
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
 *
 *  @OA\Post(
 *     path="/contacts",
 *     summary="Store new contact",
 *     tags={"contacts"},
 *     security={{"sanctum": {}}},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Ivanov Ivan"),
 *              @OA\Property(
 *                  property="phone",
 *                  type="array",
 *                  example={ "8 (958) 035-63-80", "+79356910752" },
 *                  @OA\Items(type="string")
 *              )
 *          )
 *     ),
 *     @OA\Response (
 *         response="200",
 *         description="Succes",
 *         @OA\JsonContent(ref="#/components/schemas/ContactResourceSchema")
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Unauthorized",
 *     ),
 *     @OA\Response(
 *        response="422",
 *        description="Wrong request",
 *     ),
 *     @OA\Response(
 *        response="500",
 *        description="Wrong",
 *     )
 * )
 *
 *  @OA\Patch(
 *     path="/contacts/{contact}",
 *     summary="Update contact",
 *     tags={"contacts"},
 *     security={{"sanctum": {}}},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Ivanov Ivan"),
 *              @OA\Property(
 *                  property="phone",
 *                  type="array",
 *                  example={ "8 (958) 035-63-80", "+79356910752" },
 *                  @OA\Items(type="string")
 *              )
 *          )
 *     ),
 *     @OA\Response (
 *         response="200",
 *         description="Succes"
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Unauthorized",
 *     ),
 *     @OA\Response(
 *        response="422",
 *        description="Wrong request",
 *     ),
 *     @OA\Response(
 *        response="500",
 *        description="Wrong",
 *     )
 * )
 *
 * @OA\Get (
 *     path="/contacts/{id}",
 *     summary="Show contact",
 *     tags={"contacts"},
 *     security={{"sanctum": {}}},
 *     @OA\Parameter(name="id", example="1", in="path"),
 *     @OA\Response (
 *         response="200",
 *         description="Succes",
 *         @OA\JsonContent(ref="#/components/schemas/ContactResourceSchema")
 *     ),
 *     @OA\Response(
 *        response="401",
 *        description="Unauthorized",
 *     ),
 *     @OA\Response(
 *        response="404",
 *        description="Not found",
 *     )
 * )
 */
class ContactControllerSchema
{
 //
}
