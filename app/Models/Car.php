<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Car.
 *
 * @package namespace App\Models;
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $model
 * @property string $year
 * @property string|null $description
 * @property string $brand_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Query\Builder|Car onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|Car withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Car withoutTrashed()
 */
class Car extends Model implements Transformable
{
    use TransformableTrait,HasFactory, SoftDeletes, Uuid;

    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model','year', 'description', 'brand_id'];


    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
