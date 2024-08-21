<?php

namespace App\Models\Trait\Build\Schedule;

/**
 * @property string title
 * @property int started_year
 * @property int ended_year
 * @property int started_weeks
 * @property int ended_weeks
 * @property int started_at
 * @property int ended_at
 * @property string location
 * @property string remark
 * @property int loop
 * @property int tips
 * @property int openness
 * @property int gmt
 * @property double latitude
 * @property double longitude
 */
trait ScheduleBuild
{

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setStartedYear($started_year)
    {
        $this->started_year = $started_year;
        return $this;
    }

    public function setEndedYear($ended_year)
    {
        $this->ended_year = $ended_year;
        return $this;
    }

    public function setStartedWeeks($started_weeks)
    {
        $this->started_weeks = $started_weeks;
        return $this;
    }

    public function setEndedWeeks($ended_weeks)
   {
       $this->ended_weeks = $ended_weeks;
       return $this;
   }

   public function setStartedAt($started_at)
   {
       $this->started_at = $started_at;
       return $this;
   }

   public function setEndedAt($ended_at)
   {
       $this->ended_at = $ended_at;
       return $this;
   }

   public function setLocation($location)
   {
       $this->location = $location;
       return $this;
   }

   public function setRemark($remark)
   {
       $this->remark = $remark;
       return $this;
   }

   public function setLoop($loop)
   {
       $this->loop = $loop;
       return $this;
   }

   public function setTips($tips)
   {
       $this->tips = $tips;
       return $this;
   }

   public function setOpenness($openness)
   {
       $this->openness = $openness;
       return $this;
   }

   public function setGmt($gmt)
   {
       $this->gmt = $gmt;
       return $this;
   }

   public function setLatitude($latitude)
   {
       $this->latitude = $latitude;
       return $this;
   }

   public function setLongitude($longitude)
   {
       $this->longitude = $longitude;
       return $this;
   }

}
