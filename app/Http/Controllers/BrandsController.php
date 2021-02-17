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
