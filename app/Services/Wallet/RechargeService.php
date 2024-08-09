<?php

namespace App\Services\Wallet;

use App\Models\Order\Order;
use App\Models\Wallet\Wallet;
use App\Models\Wallet\WalletFund;
use App\Models\Wallet\WalletLog;

/**
 * 生成充值记录->生成订单记录流水
 */
class RechargeService
{
    private $amount;

    /** @var Order */
    private $order;

    private $wallet_id;

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    public function setWalletId($wallet_id)
    {
        $this->wallet_id = $wallet_id;
        return $this;
    }

    public function execute()
    {
        if ($this->generateFund()) {

            $balance = WalletFund::findFundByUnit($this->wallet_id, $this->order->unit_id);

            if (empty($balance)) {
                throw new \Exception('钱包余额记录不存在');
            } else {
                $balance_array = $balance->toArray();

                $this->updateWallet($balance_array['cumulative_amount'],$balance_array['total_balance']);

                $this->generateWalletLog($balance_array['total_balance']);

            }
        }

    }

    /**
     * 生成入账流水
     *
     * @param $total_balance
     * @return WalletLog|null
     */
    private function generateWalletLog($total_balance)
    {
        return (new WalletLogService)->setWalletID($this->wallet_id)
            ->setOrderSN($this->order->sn)
            ->setUnitID($this->order->unit_id)
            ->setAmount($this->amount)
            ->setSurplus($total_balance)
            ->input();
    }

    /**
     * 生成资金数据
     *
     * @return bool
     */
    private function generateFund()
    {
        return (new WalletFund)
            ->setOrderSN($this->order->sn)
            ->setWalletID($this->wallet_id)
            ->setUnitID($this->order->unit_id)
            ->setDenomination($this->amount)
            ->setBalance($this->amount)
            ->save();
    }

    /**
     * 更新钱包余额记录
     *
     * @param $cumulative_amount
     * @param $total_balance
     * @return void
     */
    private function updateWallet($cumulative_amount,$total_balance){
        // 更新钱包余额记录
        $wallet = Wallet::findOneByID($this->wallet_id, ['unitBalance']);

        $wallet->unitBalance()->updateExistingPivot(
            $this->order->unit_id,
            [
                'cumulative_amount' => $cumulative_amount,
                'total_balance' => $total_balance
            ]
        );
    }
}
