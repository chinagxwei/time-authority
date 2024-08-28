<?php

namespace App\Models\Organization;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Order\OrderBuild;
use App\Models\Trait\SearchTrait;
use App\Models\Trait\SignTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string name
 * @property string remark
 * @property int created_by
 * @property int updated_by
 */
class Organization extends SystemBaseModel
{
    use HasFactory, SoftDeletes,
        OrderBuild, CreatedRelation, UpdatedRelation,
        SearchTrait;

    protected $table = 'organizations';

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
        'name', 'remark', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.

        $this->fill($param);

        $build = $this;

        if (!empty($this->name)) {
            $build = $build->where('name', 'like', "%{$this->name}%");
        }

        return $build->with($with);
    }
}
