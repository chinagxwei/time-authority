<?php

namespace App\Models\Trait\Build\Wallet;

/**
 * @property string wallet_id
 * @property string order_sn
 * @property int amount
 * @property int surplus
 * @property int type
 */
trait WalletLogBuild
{

    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }

    public function setSurplus($surplus){
        $this->surplus = $surplus;
        return $this;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }
}
