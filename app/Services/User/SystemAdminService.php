<?php

namespace App\Services\User;

use App\Models\System\SystemAdmin;
use App\Models\System\SystemRole;

class SystemAdminService extends UserCommonInterface
{
    private $remark;

    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    public function register()
    {
        // TODO: Implement register() method.

        if (!$this->username || !$this->password || !$this->email) {
            throw new \Exception('admin params error');
        }

        $baseUser = [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ];

        $user = new \App\Models\User();

        $user->fill($baseUser)->save();

        return $user->admin()
            ->save(
                new SystemAdmin([
                    'nickname' => 'admin_' . mt_rand(100000, 999999),
                    'remark' => $this->remark,
                    'role_id' => $this->role_id
                ])
            ) ? $user : null;
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
}
