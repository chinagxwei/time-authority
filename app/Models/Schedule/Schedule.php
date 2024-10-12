<?php

namespace App\Models\Schedule;

use App\Models\Classify\Tag;
use App\Models\Classify\Topic;
use App\Models\Quest\Quest;
use App\Models\Relation\CreatedRelation;
use App\Models\Relation\MemberRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\SystemBaseModel;
use App\Models\Trait\Build\Schedule\ScheduleBuild;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string member_id
 * @property string quest_id
 * @property string title
 * @property int started_year
 * @property int ended_year
 * @property int started_weeks
 * @property int ended_weeks
 * @property int started_at
 * @property int ended_at
 * @property int tips
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 * @property Quest quest
 */
class Schedule extends SystemBaseModel
{
    use HasFactory, SoftDeletes, SearchTrait,
        CreatedRelation, UpdatedRelation, ScheduleBuild,
        MemberRelation;

    protected $table = 'schedules';

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
        'member_id', 'quest_id', 'title', 'started_year',
        'ended_year', 'started_weeks', 'ended_weeks',
        'started_at', 'ended_at', 'remark', 'tips',
        'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    public function tags()
    {
        // TODO: Implement search() method.
        return $this->belongsToMany(
            Tag::class,
            'schedules_tags',
            'schedule_id',
            'tag_id'
        );
    }

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'schedules_topics',
            'schedule_id',
            'topic_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sales()
    {
        return $this->hasOne(ScheduleSales::class, 'schedule_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quest()
    {
        return $this->hasOne(Quest::class, 'id', 'quest_id');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

//        if (!empty($this->year)) {
//            $build = $build->where('year', $this->year);
//        }
//
//        if (!empty($this->started_weeks)) {
//            $build = $build->where('started_weeks', $this->started_weeks);
//        }
//
//        if (!empty($this->ended_weeks)) {
//            $build = $build->where('ended_weeks', $this->ended_weeks);
//        }
//
//        if (!empty($this->started_at)) {
//            $build = $build->where('started_at', $this->started_at);
//        }
//
//        if (!empty($this->ended_at)) {
//            $build = $build->where('ended_at', $this->ended_at);
//        }

        if (!empty($this->remark)) {
            $build = $build->where('remark', 'like', "%{$this->remark}%");
        }

        if (isset($this->tips)) {
            $build = $build->where('tips', $this->tips);
        }

        return $build->with($with);
    }
}
