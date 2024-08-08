<?php

namespace App\Services\User;

use App\Models\System\SystemAdmin;
use App\Models\System\SystemRole;

class SystemAdminService extends UserCommonInterface
{

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
                new SystemAdmin(['nickname' => 'admin', 'role_id' => $this->role_id])
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
}
