<?php

namespace App\Services\Wallet;

use App\Models\Wallet\WalletLog;

/**
 * 钱包日志服务
 */
class WalletLogService
{

    private $wallet_id;

    private $order_sn;

    private $unit_id;

    private $amount;
    private $surplus;

    public function setWalletID($wallet_id)
    {
        $this->wallet_id = $wallet_id;
        return $this;
    }

    public function setOrderSN($order_sn)
    {
        $this->order_sn = $order_sn;
        return $this;
    }

    public function setUnitID($unit_id)
    {
        $this->unit_id = $unit_id;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setSurplus($surplus)
    {
        $this->surplus = $surplus;
        return $this;
    }

    /**
     * 入账
     *
     * @return WalletLog|null
     */
    public function input()
    {
        return self::generate(
            $this->wallet_id,
            $this->order_sn,
            $this->unit_id,
            abs($this->amount),
            $this->surplus,
            WalletLog::FLOW_TYPE_INPUT
        );
    }

    /**
     * 出账
     *
     * @return WalletLog|null
     */
    public function output()
    {
        return self::generate(
            $this->wallet_id,
            $this->order_sn,
            $this->unit_id,
            abs($this->amount),
            $this->surplus,
            WalletLog::FLOW_TYPE_OUTPUT
        );
    }

    public static function generate($wallet_id, $order_sn, $unit_id, $amount, $surplus, $type)
    {
        $log = (new WalletLog())->setWalletID($wallet_id)
            ->setOrderSN($order_sn)
            ->setUnitID($unit_id)
            ->setAmount($amount)
            ->setSurplus($surplus)
            ->setType($type)
            ->setSign();

        return $log->save() ? $log : null;
    }
}
