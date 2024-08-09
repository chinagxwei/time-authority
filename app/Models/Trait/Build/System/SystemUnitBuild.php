<?php

namespace App\Models\Trait\Build\System;

/**
 * @property int title
 * @property int description
 * @property int label
 * @property int symbol
 * @property int exchange_rate
 * @property int finance
 */
trait SystemUnitBuild
{
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function setLabel($label){
        $this->label = $label;
        return $this;
    }

    public function setSymbol($symbol){
        $this->symbol = $symbol;
        return $this;
    }

    public function setFinance($finance){
        $this->finance = $finance;
        return $this;
    }

    public function setExchangeRate($exchange_rate){
        $this->exchange_rate = $exchange_rate;
        return $this;
    }
}
