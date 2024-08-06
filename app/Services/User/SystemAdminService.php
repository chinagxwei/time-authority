<?php

namespace App\Services\User;

use App\Models\System\SystemAdmin;
use App\Models\System\SystemRole;

class SystemAdminService implements UserCommonInterface
{
    private $username;

    private $password;

    private $email;

    private $role_id;

    private $user_type;


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

    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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
            'user_type' => $this->user_type ?? SystemRole::USER_TYPE_PLATFORM_MANAGER,
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
