<?php

namespace App\Models\System;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\System\SystemNavigationBuild;
use App\Models\Trait\SearchTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int parent_id
 * @property string navigation_name
 * @property string navigation_link
 * @property int navigation_sort
 * @property int menu_show
 * @property string icon
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 * @property SystemNavigation[]|Collection children
 * @property SystemNavigation parent
 */
class SystemNavigation extends SystemBaseModel
{
    use SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait, SystemNavigationBuild;

    public const USER_NAVIGATION_KEY = "user_system_navigations";

    public const DEFAULT_WITH_CHILDREN_FIELD = 'children:id,parent_id,navigation_name,navigation_link,menu_show,icon,navigation_sort';

    protected $table = 'system_navigations';

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
        'parent_id', 'navigation_name', 'navigation_link',
        'navigation_sort', 'menu_show', 'icon', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(SystemNavigation::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(SystemNavigation::class, "id", "parent_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|static[]
     * */
    public static function getParentAll($with = [])
    {
        return self::query()
            ->select([
                'id', 'parent_id', 'navigation_name',
                'navigation_link', 'menu_show', 'icon', 'navigation_sort'
            ])->where(function ($query) {
                $query->orWhereNull('parent_id')->orWhere('parent_id', 0);
            })->with($with)->orderBy('navigation_sort')->get();
    }

    /**
     * @param $parent_id
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function findOneByParent($parent_id, $with = [])
    {
        return self::query()
            ->select([
                'id', 'parent_id', 'navigation_name',
                'navigation_link', 'menu_show', 'icon', 'navigation_sort'
            ])->where('parent_id', $parent_id)
            ->with($with)
            ->orderBy('navigation_sort')
            ->get();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if ($this->navigation_name) {
            $build = $build->where('navigation_name', 'like', "%{$this->navigation_name}%");
        }
        return $build->with($with)->orderBy('id', 'desc');
    }

    /**
     * @param $navigation_name
     * @param $icon
     * @param $created_by
     * @param $sort
     * @param null $navigation_link
     * @return static|null
     */
    public static function generateParent($navigation_name, $icon, $created_by, $sort, $navigation_link = null)
    {
        $model = new static();
        $model->setNavigationName($navigation_name)
            ->setIcon($icon)
            ->setNavigationSort($sort)
            ->setCreatedBy($created_by);
        if (empty($navigation_link)) {
            $model->setNavigationLink($navigation_link);
        }

        return $model->save() ? $model : null;
    }
}
