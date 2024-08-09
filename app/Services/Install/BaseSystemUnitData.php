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
                'title' => '积分',
                'description' => '积分',
                'label' => '积分',
                'exchange_rate' => 1,
                'symbol' => '',
                'finance' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'title' => 'RMB',
                'description' => 'RMB',
                'label' => 'RMB',
                'symbol' => '￥',
                'exchange_rate' => 100,
                'finance' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }
}
