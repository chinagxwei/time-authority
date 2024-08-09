<?php

namespace App\Models\Relation;

use App\Models\Order\Order;

/**
 * @property string order_sn
 * @property Order order
 */
trait OrderRelation
{
    public function setOrderSN($order_sn)
    {
        $this->order_sn = $order_sn;
        return $this;
    }

    /**
     * @param $order_sn
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function findOneByOrderSN($order_sn, $with = [])
    {
        return self::query()->where('order_sn', $order_sn)->with($with)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'sn', 'order_sn');
    }
}
