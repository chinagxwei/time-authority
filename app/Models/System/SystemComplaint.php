<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemComplaintBuild;
use App\Models\Trait\SearchTrait;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string id
 * @property string title
 * @property string content
 * @property int type
 * @property int status
 * @property int created_by
 * @property Carbon created_at
 */
class SystemComplaint extends SystemBaseModel
{
    use HasFactory, SoftDeletes, Uuids, SystemComplaintBuild, CreatedRelation, SearchTrait;

    protected $table = 'system_complaints';

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
        'title', 'content', 'type', 'status', 'created_by'
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
        if (!empty($this->content)) {
            $build = $build->where('content', 'like', "%{$this->content}%");
        }
        return $build->with($with);
    }
}
