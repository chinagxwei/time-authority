<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemFileBuild;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string title
 * @property string description
 * @property string url
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class SystemFile extends SystemBaseModel
{
    use HasFactory, SoftDeletes, Uuids, SystemFileBuild, CreatedRelation, UpdatedRelation, SearchTrait;

    protected $table = 'system_files';

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
        'title', 'description', 'url', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }
        if (!empty($this->description)) {
            $build = $build->where('description', 'like', "%{$this->description}%");
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
