<?php

namespace App\Models\Trait\Build\Schedule;

/**
 * @property string schedule_id
 * @property int price
 * @property int unit_id
 * @property string order_sn
 * @property int status
 * @property int openness
 */
trait ScheduleSaleBuild
{
    public function setScheduleId($schedule_id){
        $this->schedule_id = $schedule_id;
        return $this;
    }

    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

    public function setUnitId($unit_id){
        $this->unit_id = $unit_id;
        return $this;
    }

    public function setOrderSn($order_sn){
        $this->order_sn = $order_sn;
        return $this;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    public function setOpenness($openness){
        $this->openness = $openness;
        return $this;
    }
}
