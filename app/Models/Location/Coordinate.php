<?php

namespace App\Models\Location;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property double latitude
 * @property double longitude
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class Coordinate extends SystemBaseModel
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait;

    protected $table = 'coordinates';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    protected $fillable = [
        'latitude', 'longitude', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->latitude)) {
            $build = $build->where('latitude', $this->latitude);
        }

        if (!empty($this->longitude)) {
            $build = $build->where('longitude', $this->longitude);
        }

        return $build->with($with);
    }
}
