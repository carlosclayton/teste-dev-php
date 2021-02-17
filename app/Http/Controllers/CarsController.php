<?php

namespace App\Http\Controllers;

use App\Repositories\CarRepository;
use App\Validators\CarValidator;

/**
 * Class CarsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CarsController extends BasicCrudController
{
    /**
     * @OA\Get(
     *     tags={"Cars"},
     *     path="/api/cars",
     *     summary="List of cars",
     *     description="Return a list of cars",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */

    /**
     * @OA\Post(
     *      tags={"Cars"},
     *      path="/api/cars",
     *      summary="Store a car",
     *      description="Return message",
     *      @OA\Parameter(
     *          name="model",
     *          description="Model field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="year",
     *          description="Year field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="brand_id",
     *          description="Model field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store car"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */

    /**
     * @OA\Get(
     *     tags={"Cars"},
     *     path="/api/cars/{id}",
     *     operationId="getCarById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of prooduct to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show car",
     *     description="Return a car",
     *     @OA\Response(response="200", description="A json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */


    /**
     * @OA\Put(
     *      tags={"Cars"},
     *      path="/api/cars/{id}",
     *      summary="Update a car",
     *      description="Update a car",
     *      operationId="getCarById",
     *      @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of car to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="model",
     *          description="Model field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="year",
     *          description="Year field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="brand_id",
     *          description="Model field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="A json"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */

    /**
     * @OA\Delete(
     *     tags={"Cars"},
     *     path="/api/cars/{id}",
     *     operationId="getCarById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of car to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a car",
     *     description="Delete a car",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */

    /**
     * @var CarRepository
     */
    protected $repository;


    /**
     * @return CarRepository
     */
    protected function model()
    {
        return $this->repository;
    }

    /**
     * @return string[]
     */
    protected function rulesStore()
    {
        return [
            'model' => 'required|max:255',
            'year' => 'required|integer',
            'car_id' => 'required|exists:cars,id',
            'description' => 'nullable'
        ];
    }

    /**
     * @return string[]
     */
    protected function rulesUpdate()
    {
        return [
            'model' => 'required|max:255',
            'year' => 'required|integer',
            'car_id' => 'required|exists:cars,id',
            'description' => 'nullable'
        ];
    }


    /**
     * CarsController constructor.
     *
     * @param CarRepository $repository
     * @param CarValidator $validator
     */
    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }
}
