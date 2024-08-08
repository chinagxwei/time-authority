<?php

namespace App\Services\User;

abstract class UserCommonInterface
{
    protected $username;

    protected $password;

    protected $email;

    protected $role_id;

    public abstract function register();

    public abstract function login();

    public abstract function logout();

    public abstract function getUserInfo();

    public abstract function resetPassword();

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

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
