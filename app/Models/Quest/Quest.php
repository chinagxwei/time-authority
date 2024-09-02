<?php

namespace App\Models\Quest;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\OrderRelation;
use App\Models\Relation\UnitRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseUuidModel;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * @property string id
 * @property string member_id
 * @property string title
 * @property int stock
 * @property int price
 * @property int unit_id
 * @property string remark
 * @property int status
 * @property int order_sn
 * @property int started_at
 * @property int ended_at
 * @property string address
 * @property double latitude
 * @property double longitude
 * @property int created_by
 * @property Carbon created_at
 */
class Quest extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes, Uuids,
        UnitRelation, OrderRelation,
        CreatedRelation, UpdatedRelation;

    protected $table = 'quests';

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
        'member_id', 'title', 'stock', 'price', 'unit_id', 'remark',
        'status', 'order_sn', 'started_at', 'ended_at', 'address',
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

        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

        if (isset($this->status)) {
            $build = $build->where('status', $this->status);
        }

        if (!empty($this->order_sn)) {
            $build = $build->where('order_sn', $this->order_sn);
        }

        if (!empty($this->address)){
            $build = $build->where('address', 'like', "%{$this->address}%");
        }

        return $build->with($with);
    }
}
