<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemConfigBuild;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string key
 * @property string value
 * @property int created_by
 * @property Carbon created_at
 */
class SystemConfig extends SystemBaseModel
{
    use HasFactory, SoftDeletes, Uuids, CreatedRelation, UpdatedRelation, SearchTrait, SystemConfigBuild;

    protected $table = 'system_configs';

    protected $keyType = 'string';
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
        'key', 'value', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->key)) {
            $build = $build->where('key', 'like', "%{$this->key}%");
        }
        if (!empty($this->value)) {
            $build = $build->where('value', 'like', "%{$this->value}%");
        }
        return $build->with($with);
    }
}
