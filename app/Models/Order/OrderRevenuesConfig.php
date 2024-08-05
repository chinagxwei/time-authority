<?php

namespace App\Models\Order;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Order\OrderRevenuesConfigBuild;
use App\Models\Trait\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 * @property double commission_ratio
 * @property int unit_id
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class OrderRevenuesConfig extends SystemBaseModel
{
    use HasFactory, SoftDeletes, OrderRevenuesConfigBuild, CreatedRelation, UpdatedRelation, SearchTrait;

    protected $table = 'order_revenue_configs';
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
        'title', 'commission_ratio', 'unit_id', 'created_by'
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
        return $build->with($with)->orderBy('id', 'desc');
    }
}
