<?php

namespace App\Models\Location;

use App\Models\Relation\CreatedRelation;
use App\Models\Relation\UpdatedRelation;
use App\Models\Schedule\Schedule;
use App\Models\SystemBaseModel;
use App\Models\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string title
 * @property string address
 * @property string latitude
 * @property string longitude
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class Venue extends SystemBaseModel
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchTrait;

    protected $table = 'venues';

    protected $keyType = 'string';

    protected $fillable = [
        'title', 'address', 'latitude', 'longitude',
        'remark', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schedules()
    {
        // TODO: Implement search() method.
        return $this->belongsToMany(
            Schedule::class,
            'venue_schedules',
            'venue_id',
            'schedule_id'
        );
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

        if (!empty($this->address)) {
            $build = $build->where('address', 'like', "%{$this->address}%");
        }

        if (!empty($this->latitude)) {
            $build = $build->where('latitude', $this->latitude);
        }

        if (!empty($this->longitude)) {
            $build = $build->where('longitude', $this->longitude);
        }

        return $build->with($with);
    }
}
