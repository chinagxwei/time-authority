<?php

namespace App\Models\Trait\Build\Order;

use Illuminate\Support\Carbon;

/**
 * @property string title
 * @property double commission_ratio
 * @property int unit_id
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
trait OrderRevenuesConfigBuild
{
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setCommissionRatio($commission_ratio){
        $this->commission_ratio = $commission_ratio;
        return $this;
    }

    public function setUnitId($unit_id){
        $this->unit_id = $unit_id;
        return $this;
    }
}
