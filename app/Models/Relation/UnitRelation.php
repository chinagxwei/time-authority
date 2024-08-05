<?php

namespace App\Models\Relation;


use App\Models\System\SystemUnit;

/**
 * @property int unit_id
 * @property SystemUnit unit
 */
trait UnitRelation
{
    public function setUnit($unit_id)
    {
        $this->unit_id = $unit_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(SystemUnit::class, 'id', 'unit_id');
    }
}
