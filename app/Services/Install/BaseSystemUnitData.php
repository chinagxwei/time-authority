<?php

namespace App\Services\Install;

class BaseSystemUnitData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return [
            [
                'title' => 'RMB',
                'description' => 'RMB',
                'label' => 'RMB',
                'symbol' => '￥',
                'finance' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'title' => '积分',
                'description' => '积分',
                'label' => '积分',
                'symbol' => '',
                'finance' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }
}
