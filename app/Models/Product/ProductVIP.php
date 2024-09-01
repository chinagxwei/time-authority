<?php

namespace App\Models\Product;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UnitRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseUuidModel;
use App\Models\Trait\Build\Product\ProductVIPBuild;
use App\Models\Trait\SearchTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property string id
 * @property string title
 * @property int day
 * @property int price
 * @property int unit_id
 * @property int show
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class ProductVIP extends SystemBaseUuidModel
{
    use HasFactory, SoftDeletes,
        CreatedRelation, UpdatedRelation,
        UnitRelation, SearchTrait,
        ProductVIPBuild;

    protected $table = 'product_vips';

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
        'title', 'day', 'price', 'unit_id', 'show', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    public static function lastOne()
    {
        return self::query()->orderBy('id', 'desc')->lock()->first();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }
        if (isset($this->show)) {
            $build = $build->where('show', $this->show);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
