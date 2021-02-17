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
            'brand_id' => 'required|exists:brands,id',
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
            'brand_id' => 'required|exists:brands,id',
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
