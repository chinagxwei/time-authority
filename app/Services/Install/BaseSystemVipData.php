<?php

namespace App\Services\Install;

class BaseSystemVipData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return [
            [
                'title' => '3天VIP',
                'day' => 3,
                'price' => 3000,
                'unit_id' => 1,
                'show' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];
    }
}
