<?php

namespace App\Services\Business;

use App\Models\Quest\Quest;

class QuestService
{
    private $member_id;

    private $title;

    private $stock;

    private $price;

    private $unit_id;

    private $remark;

    private $start_date;

    private $end_date;

    private $address;

    private $latitude;

    private $longitude;

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

    public function setCore($stock, $price, $unit_id)
    {
        $this->stock = $stock;
        $this->price = $price;
        $this->unit_id = $unit_id;
        return $this;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    public function setDate($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function setLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        return $this;
    }

    public function execute()
    {
        if (
            empty($this->member_id) || empty($this->title) ||
            empty($this->stock) || empty($this->price) ||
            empty($this->unit_id) || empty($this->start_date) ||
            empty($this->end_date)
        ) {
            throw new \Exception('参数缺失');
        }

        $data = [
            'member_id' => $this->member_id,
            'title' => $this->title,
            'stock' => $this->stock,
            'price' => $this->price,
            'unit_id' => $this->unit_id,
            'remark' => $this->remark,
            'order_sn'=>'',
            'started_at' => $this->start_date,
            'ended_at' => $this->end_date,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];

        return Quest::query()->create($data);
    }
}
