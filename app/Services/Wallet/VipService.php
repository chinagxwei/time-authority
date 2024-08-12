<?php

namespace App\Services\Wallet;

use App\Models\Member\MemberVIP;
use App\Models\Product\ProductVIP;

class VipService extends BaseOnOrder
{
    private $vip_id;

    private $member_id;

    public function setVipId($vip_id)
    {
        $this->vip_id = $vip_id;
        return $this;
    }

    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    public function execute()
    {
        if (empty($this->order)) {
            throw new \Exception('订单不存在');
        }

        if (empty($this->vip_id)) {
            throw new \Exception('VIP ID错误');
        }

        return $this->generateVip();
    }

    private function generateVip()
    {
        $product_vip = ProductVIP::findOneByID($this->vip_id);

        $started_at = time();

        $ended_at = $started_at + ($product_vip->day * 24 * 60 * 60);

        return (new MemberVIP())->setVipId($this->vip_id)
            ->setMemberID($this->member_id)
            ->setOrderSN($this->order->sn)
            ->setStartedAt($started_at)
            ->setEndedAt($ended_at)
            ->save();
    }
}
