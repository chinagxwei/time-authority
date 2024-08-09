<?php

namespace App\Models\Trait\Build\Order;

/**
 * @property string third_party_payment_sn
 * @property string third_party_merchant_id
 * @property int order_type
 * @property string member_id
 * @property int pay_method
 * @property int unit_id
 * @property int pay_at
 * @property int pay_status
 * @property int total_amount
 * @property int reduce_amount
 * @property int pay_amount
 * @property int commission_amount
 * @property int real_income_amount
 * @property int cancel_at
 */
trait OrderBuild
{
    public function setThirdPartyPaymentSn($third_party_payment_sn)
    {
        $this->third_party_payment_sn = $third_party_payment_sn;
        return $this;
    }

    public function setThirdPartyMerchantId($third_party_merchant_id)
    {
        $this->third_party_merchant_id = $third_party_merchant_id;
        return $this;
    }

    public function setOrderType($order_type)
    {
        $this->order_type = $order_type;
        return $this;
    }

    public function setPayMethod($pay_method)
    {
        $this->pay_method = $pay_method;
        return $this;
    }

    public function setPayAt($pay_at)
    {
        $this->pay_at = $pay_at;
        return $this;
    }

    public function setPayStatus($pay_status)
    {
        $this->pay_status = $pay_status;
        return $this;
    }

    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
        return $this;
    }

    public function setReduceAmount($reduce_amount)
    {
        $this->reduce_amount = $reduce_amount;
        return $this;
    }

    public function setPayAmount($pay_amount)
    {
        $this->pay_amount = $pay_amount;
        return $this;
    }

    public function setCommissionAmount($commission_amount)
    {
        $this->commission_amount = $commission_amount;
        return $this;
    }

    public function setRealIncomeAmount($real_income_amount)
    {
        $this->real_income_amount = $real_income_amount;
        return $this;
    }

    public function setCancelAt($cancel_at)
    {
        $this->cancel_at = $cancel_at;
        return $this;
    }
}
