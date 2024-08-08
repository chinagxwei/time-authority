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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'sn', 'order_sn');
    }
}
