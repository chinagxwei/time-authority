<?php

namespace App\Models\Trait\Build\Wallet;


/**
 * @property string order_sn
 * @property string wallet_id
 * @property int denomination
 * @property int balance
 * @property int unit_id
 * @property int frozen
 * @property int gift
 */
trait WalletFundBuild
{

    public function setDenomination($denomination){
        $this->denomination = $denomination;
        return $this;
    }

    public function setBalance($balance){
        $this->balance = $balance;
        return $this;
    }

    public function setFrozen($frozen){
        $this->frozen = $frozen;
        return $this;
    }

    public function setGift($gift){
        $this->gift = $gift;
        return $this;
    }
}
