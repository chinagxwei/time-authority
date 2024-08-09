<?php

namespace App\Models\Wallet;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\OrderRelation;
use App\Models\Relation\UnitRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\Relation\WalletRelation;
use App\Models\SystemBaseModel;
use App\Models\SystemBaseUuidModel;
use App\Models\Trait\Build\Wallet\WalletLogBuild;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * @property string id
 * @property string wallet_id
 * @property string unit_id
 * @property string order_sn
 * @property int amount
 * @property int surplus
 * @property int type
 * @property string sign
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class WalletLog extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes, CreatedRelation,
        UpdatedRelation, OrderRelation, WalletRelation,
        SearchTrait, SignTrait, WalletLogBuild, UnitRelation;

    protected $table = 'wallet_logs';

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
        'wallet_id', 'order_sn', 'unit_id', 'amount', 'surplus', 'type', 'sign', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    const FLOW_TYPE_INPUT = 1;

    const FLOW_TYPE_OUTPUT = 2;

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;

        if (!empty($this->wallet_id)) {
            $build = $build->where('wallet_id', $this->wallet_id);
        }
        if (!empty($this->wallet_recharge_id)) {
            $build = $build->where('wallet_recharge_id', $this->wallet_recharge_id);
        }

        if (isset($this->type)) {
            $build = $build->where('type', $this->type);
        }

        if (!empty($this->order_sn)) {
            $build = $build->where('order_sn', 'like', "%{$this->order_sn}%");
        }

        return $build->with($with)->orderBy('created_at', 'desc');

    }

    public function toOutput($surplus)
    {
        // TODO: Implement toOuput() method.
        return [
            'wallet_id' => $this->wallet_id,
            'order_sn' => $this->order_sn,
            'unit_id' => $this->unit_id,
            'amount' => $this->amount,
            'surplus' => $surplus,
            'sign' => sha1(join('_', [
                $this->wallet_id ?? 0,
                $this->order_sn ?? '',
                $this->amount ?? 0,
                $surplus ?? 0,
                $this->type ?? 0,
            ])),
            'type' => WalletLog::FLOW_TYPE_OUTPUT
        ];
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            $this->wallet_id ?? 0,
            $this->order_sn ?? '',
            $this->amount ?? 0,
            $this->surplus ?? 0,
            $this->type ?? 0,
        ];

        $this->sign = sha1(join('_', $raw));
        return $this;
    }
}
