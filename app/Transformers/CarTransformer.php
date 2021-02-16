<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Car;

/**
 * Class CarTransformer.
 *
 * @package namespace App\Transformers;
 */
class CarTransformer extends TransformerAbstract
{
    /**
     * Transform the Car entity.
     *
     * @param \App\Models\Car $model
     *
     * @return array
     */
    public function transform(Car $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
