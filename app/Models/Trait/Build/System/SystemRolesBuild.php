<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string role_name
 * @property int role_type
 */
trait SystemRolesBuild
{
    public function setRoleName(string $role_name)
    {
        $this->role_name = $role_name;
        return $this;
    }

    public function setRoleType(int $role_type)
    {
        $this->role_type = $role_type;
        return $this;
    }
}
