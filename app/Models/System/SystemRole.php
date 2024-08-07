<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemRolesBuild;
use App\Models\Trait\SearchTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string role_name
 * @property int role_type
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 * @property SystemNavigation[]|Collection navigations
 * @property SystemRouter[]|Collection routers
 */
class SystemRole extends SystemBaseModel
{
    use HasFactory, SoftDeletes, SystemRolesBuild, CreatedRelation, UpdatedRelation, SearchTrait;

    protected $table = 'system_roles';

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
        'role_name', 'role_type', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    const USER_TYPE_MEMBER = 1;

    const USER_TYPE_PLATFORM_MANAGER = 100;

    const USER_TYPE_PLATFORM_SUPER_ADMIN = 999;

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return self::USER_TYPE_PLATFORM_SUPER_ADMIN === $this->user_type;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function navigations()
    {
        return $this->belongsToMany(
            SystemNavigation::class,
            'system_role_navigations',
            'role_id',
            'navigation_id'
        )->with([SystemNavigation::DEFAULT_WITH_CHILDREN_FIELD])->orderBy('navigation_sort');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function routers()
    {
        return $this->belongsToMany(
            SystemRouter::class,
            'system_role_routers',
            'role_id',
            'router_id'
        )->select(['id', 'router']);
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->role_name)) {
            $build = $build->where('role_name', 'like', "%{$this->role_name}%");
        }
        if (!empty($this->role_type)) {
            $build = $build->where('role_type', $this->role_type);
        }
        return $build->with($with);
    }

    /**
     * @param $role_name
     * @param null $created_by
     * @return static|null
     */
    public static function generate($role_name, $created_by = null)
    {
        $model = new static();
        $model->role_name = $role_name;
        $model->created_by = $created_by;
        return $model->save() ? $model : null;
    }
}
