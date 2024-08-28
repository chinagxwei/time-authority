<?php

namespace App\Models\Withdrawal;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseUuidModel;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use App\Models\Wallet\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $wallet_id
 * @property string $withdraw_account_id
 * @property int $withdrawal_amount_config_id
 * @property string $order_sn
 * @property string $third_party_payment_sn
 * @property string $third_party_merchant_id
 * @property int $amount
 * @property int $status
 * @property string $remark
 * @property string $sign
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 * @property Wallet wallet
 */
class Withdrawal extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait, SignTrait;

    protected $table = 'withdrawals';

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
        'wallet_id',
        'withdraw_account_id',
        'withdrawal_amount_config_id',
        'order_sn',
        'third_party_payment_sn',
        'third_party_merchant_id',
        'amount',
        'status',
        'remark',
        'sign'
    ];

    protected $hidden = [
        'deleted_by', 'updated_by','deleted_at', 'updated_at'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);

        $build = $this;

        if (!empty($this->wallet_id)) {
            $build = $build->where('wallet_id', $this->wallet_id);
        }

        if (!empty($this->withdraw_account_id)) {
            $build = $build->where('withdraw_account_id', $this->withdraw_account_id);
        }

        if (!empty($this->withdrawal_amount_config_id)) {
            $build = $build->where('withdrawal_amount_config_id', $this->withdrawal_amount_config_id);
        }

        if (!empty($this->order_sn)) {
            $build = $build->where('order_sn', 'like', "%{$this->order_sn}%");
        }

        if (!empty($this->third_party_payment_sn)) {
            $build = $build->where('third_party_payment_sn', 'like', "%{$this->third_party_payment_sn}%");
        }

        if (isset($this->status)) {
            $build = $build->where('status', $this->status);
        }

        return $build->with($with);
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            "wallet_$this->created_by",
        ];

        $this->sign = sha1(join('_', $raw));
    }
}
