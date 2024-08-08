<?php

namespace App\Models\Wallet;

use App\Models\Relation\UnitRelation;
use App\Models\Relation\WalletRelation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string wallet_id
 * @property int unit_id
 * @property int cumulative_amount
 * @property int total_balance
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class WalletUnitBalance extends Pivot
{
    use HasFactory, UnitRelation, WalletRelation;

    const DEFAULT_RECHARGE_UNIT = 1;
    const DEFAULT_WITHDRAW_BALANCE_UNIT = 2;

    const DEFAULT_GAME_CURRENCY_UNIT = 4;

    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'wallet_unit_balance';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    protected $fillable = [
        'wallet_id', 'unit_id', 'total_balance',
        'cumulative_amount', 'sign'
    ];

    /**
     * @param $wallet_id
     * @param $unit_id
     * @return bool
     */
    public static function hasRow($wallet_id, $unit_id)
    {
        return self::query()->where('wallet_id', $wallet_id)->where('unit_id', $unit_id)->exists();
    }

    /**
     * @param $wallet_id
     * @param $unit_id
     * @param array $with
     * @param bool $lock
     * @return Builder|static
     */
    public static function findOne($wallet_id, $unit_id, $with = [], $lock = false)
    {
        return self::query()
            ->where('wallet_id', $wallet_id)
            ->where('unit_id', $unit_id)
            ->with($with)
            ->lock($lock)
            ->first();
    }
}
