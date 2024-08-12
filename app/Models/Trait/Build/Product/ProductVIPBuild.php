<?php

namespace App\Models\Trait\Build\Product;

/**
 * @property string title
 * @property int day
 * @property int price
 * @property int show
 */
trait ProductVIPBuild
{
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setDay($day){
        $this->day = $day;
        return $this;
    }

    public function setPrice($price){
        $this->price = $price;
        return $this;
    }
}
