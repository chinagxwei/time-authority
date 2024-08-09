<?php

namespace App\Services\User;

use App\Models\Member\Member;
use App\Models\System\SystemUnit;
use App\Models\Wallet\Wallet;

class MemberService extends UserCommonInterface
{

    private $nickname;

    private $mobile;

    private $order_revenue_config_id;

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function setOrderRevenueConfigId($order_revenue_config_id)
    {
        $this->order_revenue_config_id = $order_revenue_config_id;
        return $this;
    }

    public function register()
    {
        // TODO: Implement register() method.
        if (!$this->username || !$this->password) {
            throw new \Exception('admin params error');
        }

        $baseUser = [
            'username' => $this->username,
            'email' => $this->email ?? "{$this->username}@platform.com",
            'password' => $this->password,
        ];

        $user = new \App\Models\User();

        $user->fill($baseUser)->save();

        return $user->member()
            ->save(
                $this->generateMember()
            ) ? $user->member : null;
    }

    public function login()
    {
        // TODO: Implement login() method.
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }

    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }

    public function resetPassword()
    {
        // TODO: Implement resetPassword() method.
    }

    /**
     * @return Member
     * @throws \Exception
     */
    private function generateMember()
    {
        if ($wallet = Wallet::generate()) {
            SystemUnit::findAllFinance()
                ->each(function (SystemUnit $unit) use ($wallet) {
                    $wallet->unitBalance()->attach($unit->id, [
                        'total_balance' => 0,
                        'cumulative_amount' => 0,
                        'sign' => md5("{$wallet->id}_0_0")
                    ]);
                });
            return new Member([
                'nickname' => $this->nickname ?? 'member_' . mt_rand(100000, 999999),
                'role_id' => $this->role_id,
                'order_revenue_config_id' => $this->order_revenue_config_id ?? 1,
                'wallet_id' => $wallet->id,
                'mobile' => $this->mobile ?? null,
                'promotion_sn' => md5('member_' . $wallet->id . '_' . mt_rand(100000, 999999))
            ]);
        }

        throw new \Exception('generate wallet error');
    }
}
