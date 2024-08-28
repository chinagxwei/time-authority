<?php

namespace App\Models\Withdrawal;

use App\Models\Relation\CreatedRelation;
use App\Models\SystemBaseUuidModel;
use App\Models\Trait\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string unit_id
 * @property string title
 * @property string commission_ratio
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class WithdrawalConfigs extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes, CreatedRelation, SearchTrait;

    protected $table = 'withdrawal_configs';

    protected $fillable = [
        'unit_id', 'title', 'commission_ratio'
    ];

    protected $hidden = [
        'deleted_by', 'updated_by','deleted_at', 'updated_at'
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

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;

        if (!empty($this->unit_id)) {
            $build = $build->where('unit_id', $this->unit_id);
        }

        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

        return $build->with($with);
    }
}
