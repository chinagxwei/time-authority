<?php

namespace App\Services\Order;

use App\Models\Order\Order;
use App\Models\System\SystemUnit;

class TradeService
{
    /**
     * @param $amount
     * @param $order_type
     * @param $unit_id
     * @return Order
     */
    public static function platformOrder($amount, $order_type = Order::ORDER_TYPE_PAY, $unit_id = 1)
    {
        return self::generate(
            $amount,
            $order_type,
            Order::PAY_METHOD_PLATFORM,
            Order::PAY_STATUS_PAI,
            $unit_id
        );
    }

    /**
     * @param $amount
     * @param $pay_method
     * @param $unit_id
     * @return Order
     */
    public static function memberOrder($amount, $pay_method = Order::PAY_METHOD_WECHAT, $unit_id = 1)
    {
        return self::generate(
            $amount,
            Order::ORDER_TYPE_PAY,
            $pay_method,
            Order::PAY_STATUS_WAITING,
            $unit_id
        );
    }

    /**
     * @param $amount
     * @param $order_type
     * @param $pay_method
     * @param $pay_status
     * @param $unit_id
     * @return Order
     */
    public static function generate($amount, $order_type, $pay_method, $pay_status, $unit_id)
    {
        $order = new Order();

        $unit = SystemUnit::findOneByID($unit_id);

        $amount = $amount * $unit->exchange_rate;

        $order->setTotalAmount($amount)
            ->setPayAmount($amount)
            ->setOrderType($order_type)
            ->setPayMethod($pay_method)
            ->setUnitID($unit_id)
            ->setPayAt(time())
            ->setPayStatus($pay_status)
            ->save();

        return $order;
    }
}
