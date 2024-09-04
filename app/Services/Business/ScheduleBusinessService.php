<?php

namespace App\Services\Business;

use App\Models\Schedule\Schedule;
use App\Models\Schedule\ScheduleSales;

class ScheduleBusinessService
{
    /** @var Schedule */
    private $schedule;

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
        return $this;
    }

    /**
     * @param $price
     * @param $unit_id
     * @param $openness
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function publishScheduleSale($price, $unit_id, $openness, $status)
    {
        if (empty($this->schedule)) {
            throw new \Exception('Schedule is empty');
        }

        $data = [
            'price' => $price,
            'unit_id' => $unit_id,
            'openness' => $openness,
            'status' => $status
        ];

        ;

        return $this->schedule->sales()->create($data);
    }
}
