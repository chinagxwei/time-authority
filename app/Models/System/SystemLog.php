<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Trait\Build\System\SystemLogBuild;
use App\Models\Trait\SearchTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string action_name
 * @property string action_description
 * @property string ip
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class SystemLog extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, SearchTrait, SystemLogBuild;

    protected $table = 'system_logs';

    protected $fillable = [
        'action_name', 'action_description', 'ip', 'created_at'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

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

    /**
     * @param $param
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($param['started_at']) && !empty($param['ended_at'])) {
            $build = $build->whereBetween('created_at', [$param['started_at'], $param['ended_at']]);
        }
        return $build->with($with);
    }

}
