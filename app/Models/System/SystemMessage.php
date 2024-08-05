<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemMessageBuild;
use App\Models\Trait\SearchTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 * @property string content
 * @property int weight
 * @property int user_type
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class SystemMessage extends SystemBaseModel
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait, SystemMessageBuild;

    protected $table = 'system_messages';

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
        'title', 'content', 'weight', 'user_type', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];


    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->admin_id)) {
            $build = $build->where('admin_id', $this->admin_id);
        }
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }
        if (!empty($this->content)) {
            $build = $build->where('content', 'like', "%{$this->content}%");
        }
        if (isset($this->weight)) {
            $build = $build->where('weight', $this->weight);
        }
        if (isset($this->user_type)) {
            $build = $build->where('user_type', $this->user_type);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
