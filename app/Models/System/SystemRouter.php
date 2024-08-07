<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemRouterBuild;
use App\Models\Trait\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string router_name
 * @property string router
 * @property int created_by
 * @property Carbon created_at
 */
class SystemRouter extends SystemBaseModel
{
    use HasFactory, SoftDeletes, SystemRouterBuild, CreatedRelation, UpdatedRelation, SearchTrait;

    public const USER_ROUTER_KEY = "user_system_routers";

    protected $table = 'system_routers';

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
        'router_name', 'router', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAll()
    {
        return self::query()->select(['router'])->get();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->router_name)) {
            $build = $build->where('router_name', 'like', "%{$this->router_name}%");
        }
        if (!empty($this->router)) {
            $build = $build->where('router', 'like', "%{$this->router}%");
        }

        return $build->with($with);
    }
}
