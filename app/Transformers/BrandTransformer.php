<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Brand;

/**
 * Class BrandTransformer.
 *
 * @package namespace App\Transformers;
 */
class BrandTransformer extends TransformerAbstract
{
    /**
     * Transform the Brand entity.
     *
     * @param \App\Models\Brand $model
     *
     * @return array
     */
    public function transform(Brand $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
