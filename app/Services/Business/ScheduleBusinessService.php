<?php

namespace App\Services\Business;

use App\Models\Schedule\Schedule;

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
    public function publishScheduleSale($price, $unit_id, $openness)
    {
        if (empty($this->schedule)) {
            throw new \Exception('Schedule is empty');
        }

        $data = [
            'schedule_id' => $this->schedule->id,
            'price' => $price,
            'unit_id' => $unit_id,
            'openness' => $openness
        ];

        return Schedule::query()->create($data);
    }
}
