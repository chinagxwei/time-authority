<?php

namespace App\Models\Wechat;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\MemberRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string member_id
 * @property string session_key
 * @property string openid
 * @property string unionid
 * @property string nickname
 * @property int sex
 * @property string city
 * @property string province
 * @property string country
 * @property string headimgurl
 * @property int subscribe_at
 * @property int unsubscribe_at
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class OfficeAccount extends SystemBaseModel
{
    use HasFactory, SoftDeletes, CreatedRelation,
        UpdatedRelation, SearchTrait, MemberRelation;

    protected $table = 'wechat_office_accounts';

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
        'member_id', 'session_key', 'openid', 'unionid',
        'nickname', 'sex', 'city', 'province', 'country',
        'headimgurl', 'subscribe_at', 'unsubscribe_at'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->nickname)) {
            $build = $build->where('nickname', 'like', "%{$this->nickname}%");
        }

        if (!empty($this->openid)) {
            $build = $build->where('openid', $this->openid);
        }

        if (!empty($this->unionid)) {
            $build = $build->where('unionid', $this->unionid);
        }

        return $build->with($with);
    }
}
