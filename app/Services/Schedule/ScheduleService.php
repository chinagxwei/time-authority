<?php

namespace App\Services\Schedule;

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

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setRemark($remark){
        $this->remark = $remark;
        return $this;
    }

    public function setLongitude($longitude){
        $this->longitude = $longitude;
        return $this;
    }

    public function setLatitude($latitude){
        $this->latitude = $latitude;
        return $this;
    }

    public function setGmt($gmt){
        $this->gmt = $gmt;
        return $this;
    }

    public function setOpenness($openness){
        $this->openness = $openness;
        return $this;
    }

    public function setTips($tips){
        $this->tips = $tips;
        return $this;
    }

    public function setLoop($loop){
        $this->loop = $loop;
        return $this;
    }

    public function setLocation($location){
        $this->location = $location;
        return $this;
    }

    public function setStartDate($start_date){
        $this->start_date = $start_date;
        return $this;
    }

    public function setEndDate($end_date){
        $this->end_date = $end_date;
        return $this;
    }

    public function execute()
    {

    }


}
