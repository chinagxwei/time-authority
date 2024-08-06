<?php

namespace App\Models\Trait\Build\Order;

/**
 * @property string to_member_id
 * @property string from_member_id
 * @property string from_order_sn
 * @property string to_order_sn
 * @property int amount
 */
trait OrderRevenuesBuild
{
    public function setToMemberId($to_member_id){
        $this->to_member_id = $to_member_id;
        return $this;
    }

    public function setFromMemberId($from_member_id){
        $this->from_member_id = $from_member_id;
        return $this;
    }

    public function setFromOrderSn($from_order_sn){
        $this->from_order_sn = $from_order_sn;
        return $this;
    }

    public function setToOrderSn($to_order_sn){
        $this->to_order_sn = $to_order_sn;
        return $this;
    }

    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }
}
