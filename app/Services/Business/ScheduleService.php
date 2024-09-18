<?php

namespace App\Services\Business;

use App\Models\Schedule\Schedule;

class ScheduleService
{
    private $title;

    private $member_id;

    private $quest_id;

    private $start_date;

    private $end_date;

    private $tips;

    private $remark;

    public function setQuestId($quest_id)
    {
        $this->quest_id = $quest_id;
        return $this;
    }

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setDate($start_date, $end_date)
    {
        $this->start_date = strtotime($start_date);
        $this->end_date = strtotime($end_date);
        return $this;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }


    public function setTips($tips)
    {
        $this->tips = $tips;
        return $this;
    }


    public function execute()
    {
        if (empty($this->start_date) || empty($this->end_date)) {
            throw new \Exception('开始时间或结束时间不能为空');
        }

        if ($this->start_date > $this->end_date){
            throw new \Exception('开始时间不能大于结束时间');
        }

        $data = [
            'title' => $this->title,
            'member_id' => $this->member_id,
            'quest_id' => $this->quest_id,
            'started_at' => $this->start_date,
            'ended_at' => $this->end_date,
            'started_weeks' => date('W', $this->start_date),
            'ended_weeks' => date('W', $this->end_date),
            'started_year' => date('Y', $this->start_date),
            'ended_year' => date('Y', $this->end_date),
            'remark' => $this->remark,
            'tips' => $this->tips,
        ];
        $schedule = (new Schedule());
        return $schedule->fill($data)->save() ? $schedule : null;
    }

}
