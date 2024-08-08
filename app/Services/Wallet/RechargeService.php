<?php

namespace App\Services\Wallet;

use App\Models\Order\Order;

/**
 * 生成订单记录->生成订单记录流水->生成充值记录
 */
class RechargeService
{
    private $amount;

    private $order;

    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }

    public function setOrder(Order $order){
        $this->order = $order;
        return $this;
    }

    public function execute(){

    }

    private function generateWalletLog(){

    }

    private function generateFund(){

    }
}
