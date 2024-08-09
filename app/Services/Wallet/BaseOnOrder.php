<?php

namespace App\Services\Wallet;

use App\Models\Order\Order;

abstract class BaseOnOrder
{
    /** @var Order */
    protected $order;

    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }
}
