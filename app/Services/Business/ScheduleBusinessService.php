<?php

namespace App\Services\Business;

use App\Models\Schedule\Schedule;
use App\Models\Schedule\ScheduleSales;
use App\Models\System\SystemUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
     * @param $amount
     * @param $unit_id
     * @param $openness
     * @param $status
     * @return Builder|Model
     * @throws \Exception
     */
    public function publishScheduleSale($amount, $unit_id, $openness, $status)
    {
        if (empty($this->schedule)) {
            throw new \Exception('Schedule is empty');
        }

        $unit = SystemUnit::findOneByID($unit_id);

        $amount = $amount * $unit->exchange_rate;

        $data = [
            'price' => $amount,
            'unit_id' => $unit_id,
            'openness' => $openness,
            'status' => $status
        ];

        return $this->schedule->sales()->create($data);
    }
}
