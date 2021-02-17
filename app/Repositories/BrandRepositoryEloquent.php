<?php

namespace App\Repositories;

use App\Presenters\BrandPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BrandRepository;
use App\Models\Brand;
use App\Validators\BrandValidator;

/**
 * Class BrandRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BrandRepositoryEloquent extends BaseRepository implements BrandRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Brand::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BrandValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BrandPresenter::class;
    }

}
