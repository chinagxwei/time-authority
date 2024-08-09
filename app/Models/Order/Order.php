<?php

namespace App\Models\Order;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\MemberRelation;
use App\Models\Relation\UnitRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Order\OrderBuild;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string id
 * @property string sn
 * @property string third_party_payment_sn
 * @property string third_party_merchant_id
 * @property int order_type
 * @property string member_id
 * @property int pay_method
 * @property int unit_id
 * @property int pay_at
 * @property int pay_status
 * @property int total_amount
 * @property int reduce_amount
 * @property int pay_amount
 * @property int commission_amount
 * @property int real_income_amount
 * @property int cancel_at
 * @property string sign
 * @property string remarks
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 * @property OrderRevenues revenue
 */
class Order extends SystemBaseModel
{
    use HasFactory, SoftDeletes, Uuids,
        OrderBuild, CreatedRelation, UpdatedRelation,
        MemberRelation, UnitRelation, SearchTrait, SignTrait;

    protected $table = 'orders';

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
        'sn', 'third_party_payment_sn', 'third_party_merchant_id',
        'member_id', 'order_type', 'unit_id', 'pay_method',
        'pay_at', 'pay_status', 'total_amount', 'reduce_amount',
        'pay_amount', 'commission_amount', 'real_income_amount',
        'cancel_at', 'sign', 'remarks', 'created_by', 'updated_by',
        'created_at'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    const ORDER_TYPE_PAY = 1;

    const ORDER_TYPE_WITHDRAWAL = 2;

    const ORDER_TYPE_COMMISSION = 3;

    const PAY_METHOD_ALIPAY = 1;

    const PAY_METHOD_WECHAT = 2;

    const PAY_METHOD_VIRTUAL = 3;

    const PAY_METHOD_PLATFORM = 10;

    const PAY_STATUS_CANCEL = -1;

    const PAY_STATUS_WAITING = 0;

    const PAY_STATUS_PAI = 1;

    public function __construct()
    {
        static::creating(function ($model) {
            if (empty($model->sn)) {
                $model->sn = date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            }
        });
    }

    public function revenue()
    {
        return $this->hasOne(OrderRevenues::class, 'from_order_sn', 'sn');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->member_id)) {
            $build = $build->where('member_id', $this->member_id);
        }
        if (!empty($this->sn)) {
            $build = $build->where('sn', 'like', "%{$this->sn}%");
        }
        if (isset($this->pay_method)) {
            $build = $build->where('pay_method', $this->pay_method);
        }
        if (isset($this->pay_status)) {
            $build = $build->where('pay_status', $this->pay_status);
        }
        if (isset($this->order_type)) {
            $build = $build->where('order_type', $this->order_type);
        }
        if (!empty($param['pay_at']) && (count($param['pay_at']) === 2)) {
            $build = $build->whereBetween('pay_at', [$param['pay_at'][0], $param['pay_at'][1]]);
        }
        if (!empty($param['cancel_at']) && (count($param['cancel_at']) === 2)) {
            $build = $build->whereBetween('cancel_at', [$param['cancel_at'][0], $param['cancel_at'][1]]);
        }
        if (!empty($param['created_at']) && (count($param['created_at']) === 2)) {
            $build = $build->whereBetween('created_at', [$param['created_at'][0], $param['created_at'][1]]);
        }

        return $build->with($with)->orderBy('id', 'desc');
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            $this->third_party_payment_sn ?? '',
            $this->third_party_merchant_id ?? '',
            $this->order_type ?? '',
            $this->member_id ?? '',
            $this->pay_method ?? '',
            $this->unit_id ?? 0,
            $this->pay_at ?? 0,
            $this->pay_status ?? 0,
            $this->total_amount ?? 0,
            $this->reduce_amount ?? 0,
            $this->pay_amount ?? 0,
            $this->commission_amount ?? 0,
            $this->real_income_amount ?? 0,
            $this->cancel_at ?? 0,
        ];

        $this->sign = sha1(join('_', $raw));
    }
}
