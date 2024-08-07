<?php

namespace App\Services\User;

interface UserCommonInterface
{
    public function register();

    public function login();

    public function logout();

    public function getUserInfo();

    public function resetPassword();
}
