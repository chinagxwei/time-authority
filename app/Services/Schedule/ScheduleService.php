<?php

namespace App\Services\Schedule;

use App\Models\Schedule\Schedule;

class ScheduleService
{
    private $title;

    private $start_date;

    private $end_date;

    private $location;

    private $loop;

    private $tips;

    private $openness;

    private $gmt;

    private $latitude;

    private $longitude;

    private $remark;

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function setGmt($gmt)
    {
        $this->gmt = $gmt;
        return $this;
    }

    public function setOpenness($openness)
    {
        $this->openness = $openness;
        return $this;
    }

    public function setTips($tips)
    {
        $this->tips = $tips;
        return $this;
    }

    public function setLoop($loop)
    {
        $this->loop = $loop;
        return $this;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
        return $this;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function execute()
    {
        if (empty($this->start_date) || empty($this->end_date)) {
            throw new \Exception('开始时间或结束时间不能为空');
        }

        $data = [
            'title' => $this->title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'started_weeks' => date_format($this->start_date, 'W'),
            'ended_weeks' => date_format($this->end_date, 'W'),
            'started_year' => date_format($this->start_date, 'Y'),
            'ended_year' => date_format($this->end_date, 'Y'),
            'remark' => $this->remark,
            'location' => $this->location,
            'loop' => $this->loop,
            'tips' => $this->tips,
            'openness' => $this->openness,
            'gmt' => $this->gmt,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
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
