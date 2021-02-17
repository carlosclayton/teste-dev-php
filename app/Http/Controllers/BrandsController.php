<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Repositories\BrandRepository;
use App\Validators\BrandValidator;

/**
 * Class BrandsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BrandsController extends BasicCrudController
{

    /**
     * @OA\Get(
     *     tags={"Brands"},
     *     path="/api/brands",
     *     summary="List of brands",
     *     description="Return a list of brands",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */

    /**
     * @OA\Post(
     *      tags={"Brands"},
     *      path="/api/brands",
     *      summary="Store a brand",
     *      description="Return message",
     *      @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     *     @OA\Response(response="200", description="Store brand"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */

    /**
     * @OA\Get(
     *     tags={"Brands"},
     *     path="/api/brands/{id}",
     *     operationId="getBrandById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of prooduct to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show brand",
     *     description="Return a brand",
     *     @OA\Response(response="200", description="A json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */


    /**
     * @OA\Put(
     *      tags={"Brands"},
     *      path="/api/brands/{id}",
     *      summary="Update a brand",
     *      description="Update a brand",
     *      operationId="getBrandById",
     *      @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of brand to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     *     tags={"Brands"},
     *     path="/api/brands/{id}",
     *     operationId="getBrandById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of brand to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a brand",
     *     description="Delete a brand",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */


    /**
     * @var BrandRepository
     */
    protected $repository;


    /**
     * @return BrandRepository
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
            'name' => 'required|max:255',
            'description' => 'nullable'
        ];
    }

    /**
     * @return string[]
     */
    protected function rulesUpdate()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'nullable'
        ];
    }


    /**
     * BrandsController constructor.
     *
     * @param BrandRepository $repository
     * @param BrandValidator $validator
     */
    public function __construct(BrandRepository $repository)
    {
        $this->repository = $repository;
    }
}
