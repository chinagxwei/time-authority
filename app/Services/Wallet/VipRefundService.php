<?php

namespace App\Services\Wallet;

use App\Models\Member\MemberVIP;
use App\Models\Order\Order;

class VipRefundService extends BaseOnOrder
{
    public function execute(){
        if (empty($this->order)){
            throw new \Exception('订单不存在');
        }

        $member_vip = MemberVIP::findOneByOrderSN($this->order->sn);

        if (empty($member_vip)){
            throw new \Exception('会员VIP不存在');
        }

        $this->order->cancel();

        $member_vip->delete();


        // 如果涉及第三方支付，还要进行第三方支付退款
        if ($this->order->pay_method == Order::PAY_METHOD_WECHAT || $this->order->pay_method == Order::PAY_METHOD_ALIPAY){

        }

        return true;
    }
}
