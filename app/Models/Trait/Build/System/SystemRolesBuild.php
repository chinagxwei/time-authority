<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string role_name
 */
trait SystemRolesBuild
{
    public function setRoleName(string $role_name): void
    {
        $this->role_name = $role_name;
    }
}
