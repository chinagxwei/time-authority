<?php

namespace App\Services\Install;

class BaseSystemCommissionRatioData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return[
            [
                'title' => '平台运营',
                'commission_ratio' => 0.03,
                'unit_id' => 1,
                'created_by' => $params[0],
                'updated_by' => $params[0],
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];
    }
}
