<?php

namespace App\Services\Order;

use App\Models\Order\Order;
use App\Models\System\SystemUnit;

class TradeService
{
    public static function platformOrder($amount, $unit_id = 1)
    {
        $order = new Order();

        $unit = SystemUnit::findOneByID($unit_id);

        $amount = $amount * $unit->exchange_rate;

        $order->setTotalAmount($amount)
            ->setPayAmount($amount)
            ->setOrderType(Order::ORDER_TYPE_PAY)
            ->setUnitID($unit_id)
            ->setPayAt(time())
            ->setPayStatus(Order::PAY_STATUS_PAI)
            ->save();

        return $order;
    }
}
