<?php

namespace App\Services\User;

use App\Models\Member\Member;
use App\Models\System\SystemUnit;
use App\Models\Wallet\Wallet;

class MemberService implements UserCommonInterface
{
    private $username;

    private $password;

    private $nickname;

    private $mobile;

    private $role_id;

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = bcrypt($password);
        return $this;
    }

    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
        return $this;
    }

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

    public function register()
    {
        // TODO: Implement register() method.
        if (!$this->username || !$this->password) {
            throw new \Exception('admin params error');
        }

        $baseUser = [
            'username' => $this->username,
            'email' => "{$this->username}@platform.com",
            'password' => $this->password,
        ];

        $user = new \App\Models\User();

        $user->fill($baseUser)->save();

        return $user->member()
            ->save(
                $this->generateMember()
            ) ? $user->admin : null;
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
                'wallet_id' => $wallet->id,
                'mobile' => $this->mobile ?? null
            ]);
        }

        throw new \Exception('generate wallet error');
    }
}
