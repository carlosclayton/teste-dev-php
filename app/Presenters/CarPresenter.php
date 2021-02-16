<?php

namespace App\Presenters;

use App\Transformers\CarTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CarPresenter.
 *
 * @package namespace App\Presenters;
 */
class CarPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CarTransformer();
    }
}
