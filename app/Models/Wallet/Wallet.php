<?php

namespace App\Models\Wallet;

use App\Models\Member\Member;
use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\System\SystemUnit;
use App\Models\SystemBaseUuidModel;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


/**
 * @property string id
 * @property string sign
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 * @property Member own
 * @property WalletUnitBalance unitBalance
 */
class Wallet extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait, SignTrait;

    protected $table = 'wallets';

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
        'sign'
    ];

    protected $hidden = [
        'deleted_by', 'updated_by','deleted_at', 'updated_at'
    ];


    /**
     * @param $total_balance
     * @return $this
     */
    public function setTotalBalance($total_balance)
    {
        $this->setSign();
        return $this;
    }

    public function own()
    {
        return $this->hasOne(Member::class, 'wallet_id', 'id');
    }

    public function unitBalance()
    {
        return $this->belongsToMany(
            SystemUnit::class,
            'wallet_unit_balance',
            'wallet_id',
            'unit_id'
        )->using(WalletUnitBalance::class)->withPivot('cumulative_amount', 'total_balance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    public static function lastOne()
    {
        return self::query()->whereNotExists(function ($query) {
            $raw = [
                DB::getTablePrefix() . 'members.wallet_id',
                DB::getTablePrefix() . 'wallets.id'
            ];
            $query->from('members')
                ->whereRaw(join('=', $raw));
        })->lock()->first();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;

        return $build->with($with);
    }

    /**
     * @return Wallet|null
     */
    public static function generate()
    {
        $model = new static();
        $model->setSign();
        return $model->save() ? self::lastOne() : null;
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
