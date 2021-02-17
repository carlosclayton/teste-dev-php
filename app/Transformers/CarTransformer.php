<?php

namespace App\Transformers;

use Carbon\Carbon;
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
            'id'         => $model->id,
            'model' => $model->model,
            'year' => $model->year,
            'brand_id' => $model->brand_id,
            'description' => $model->description,
            'created_at' => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'),
            'deleted_at' => ($model->deleted_at == null) ? null :
                Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s'),
        ];
    }
}
