<?php

namespace App\Services\Wallet;

use App\Models\Order\Order;
use App\Models\Wallet\Wallet;
use App\Models\Wallet\WalletFund;
use App\Models\Wallet\WalletLog;
use App\Services\Order\TradeService;

class RechargeRefundService extends BaseOnOrder
{

    private $wallet_id;

    public function setWalletID($wallet_id)
    {
        $this->wallet_id = $wallet_id;
        return $this;
    }

    public function execute()
    {

        if (empty($this->order) || empty($this->wallet_id)) {
            throw new \Exception('订单不存在');
        }

        $this->order->cancel();


        $funds = WalletFund::getFundByOrder($this->order->sn);

        $funds->each(function ($fund) {
            $fund->delete();
        });

        $surplus = $this->updateWallet();

        /** @var WalletLog $log */
        $log = WalletLog::findOneByOrderSN($this->order->sn);

        $output = $log->toOutput($surplus ?? 0);

        WalletLog::query()->create($output);
    }

    private function updateWallet()
    {
        $balance = WalletFund::findFundByUnit($this->wallet_id, $this->order->unit_id);

        $balance_array = $balance->toArray();

        // 更新钱包余额记录
        $wallet = Wallet::findOneByID($this->wallet_id, ['unitBalance']);

        $wallet->unitBalance()->updateExistingPivot(
            $this->order->unit_id,
            [
                'cumulative_amount' => $balance_array['cumulative_amount'] ?? 0,
                'total_balance' => $balance_array['total_balance'] ?? 0
            ]
        );

        return $balance_array['total_balance'];
    }
}
