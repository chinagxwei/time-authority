<?php

namespace App\Models\Schedule;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Schedule\ScheduleSaleBuild;
use App\Models\Trait\SearchTrait;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string schedule_id
 * @property int price
 * @property int unit_id
 * @property string order_sn
 * @property int status
 * @property int openness
 * @property Carbon created_at
 * @property Schedule schedule
 */
class ScheduleSales extends SystemBaseModel
{
    use HasFactory, SoftDeletes, Uuids, SearchTrait,
        CreatedRelation, UpdatedRelation, ScheduleSaleBuild;

    protected $table = 'schedule_sales';

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
        'schedule_id', 'price', 'unit_id', 'order_sn', 'status', 'openness',
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->schedule_id)) {
            $build = $build->where('schedule_id', $this->schedule_id);
        }
        if (!empty($this->price)) {
            $build = $build->where('price', $this->price);
        }

        if (!empty($this->order_sn)) {
            $build = $build->where('order_sn', $this->order_sn);
        }

        if (isset($this->status)) {
            $build = $build->where('status', $this->status);
        }

        if (isset($this->openness)) {
            $build = $build->where('openness', $this->openness);
        }

        return $build->with($with);
    }
}
