<?php

namespace App\Models\Order;

use App\Models\Member\Member;
use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Order\OrderRevenuesBuild;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property String id
 * @property string to_member_id
 * @property string from_member_id
 * @property string from_order_sn
 * @property string to_order_sn
 * @property int amount
 * @property string sign
 * @property int created_by
 * @property int updated_by
 * @property Order formOrder
 * @property Order toOrder
 * @property Member formMember
 * @property Member toMember
 */
class OrderRevenues extends SystemBaseModel
{
    use HasFactory, SoftDeletes, OrderRevenuesBuild, CreatedRelation, UpdatedRelation, SearchTrait, SignTrait;

    protected $table = 'order_revenues';
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
        'to_member_id', 'from_member_id', 'from_order_sn', 'to_order_sn',
        'amount', 'sign', 'created_by', 'category', 'unit_id'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formMember()
    {
        return $this->hasOne(Member::class, 'id', 'from_member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toMember()
    {
        return $this->hasOne(Member::class, 'id', 'to_member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formOrder()
    {
        return $this->hasOne(Order::class, 'sn', 'from_order_sn');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toOrder()
    {
        return $this->hasOne(Order::class, 'sn', 'to_order_sn');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->to_member_id)) {
            $build = $build->where('to_member_id', $this->to_member_id);
        }
        if (!empty($this->from_member_id)) {
            $build = $build->where('from_member_id', $this->from_member_id);
        }
        if (!empty($this->from_order_sn)) {
            $build = $build->where('from_order_sn', 'like', "%{$this->from_order_sn}%");
        }
        if (!empty($this->to_order_sn)) {
            $build = $build->where('to_order_sn', 'like', "%{$this->to_order_sn}%");
        }
        if (!empty($param['created_at']) && count($param['created_at']) === 2) {
            $build = $build->whereBetween('created_at', [$param['created_at'][0], $param['created_at'][1]]);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            $this->member_id ?? '',
            $this->from_order_sn ?? '',
            $this->to_order_sn ?? 0,
            $this->amount ?? 0,
        ];

        $this->sign = sha1(join('_', $raw));
    }
}
