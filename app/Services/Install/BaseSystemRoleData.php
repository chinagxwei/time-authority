<?php

namespace App\Services\Install;

use App\Models\System\SystemRole;

class BaseSystemRoleData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return [
            [
                'role_name' => '超级管理员',
                'role_type' => SystemRole::USER_TYPE_PLATFORM_SUPER_ADMIN,
                'created_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'role_name' => '会员',
                'role_type' => SystemRole::USER_TYPE_MEMBER,
                'created_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];
    }
}
