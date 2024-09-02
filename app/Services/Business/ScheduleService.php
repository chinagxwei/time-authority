<?php

namespace App\Services\Business;

use App\Models\Schedule\Schedule;

class ScheduleService
{
    private $title;

    private $start_date;

    private $end_date;

    private $tips;

    private $remark;

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setDate($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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

        $data = [
            'title' => $this->title,
            'started_at' => $this->start_date,
            'ended_at' => $this->end_date,
            'started_weeks' => date_format($this->start_date, 'W'),
            'ended_weeks' => date_format($this->end_date, 'W'),
            'started_year' => date_format($this->start_date, 'Y'),
            'ended_year' => date_format($this->end_date, 'Y'),
            'remark' => $this->remark,
            'tips' => $this->tips,
        ];

        Schedule::query()->create($data);
    }


//    /**
//     * 创建当前服务测试用例
//     */
//    public function test()
//    {
//        $this->setTitle('测试')
//            ->setStartDate(new \DateTime('2021-01-01'))
//            ->setEndDate(new \DateTime('2021-01-02'))
//            ->setLocation('测试地址')
//            ->setLoop(1)
//            ->setTips(1)
//            ->setOpenness(1)
//            ->setGmt(1)
//            ->setLatitude(1)
//            ->setLongitude(1)
//            ->setRemark('测试备注')
//            ->execute();
//    }
}
