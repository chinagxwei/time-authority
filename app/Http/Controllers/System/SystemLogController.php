<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;

use App\Models\System\SystemLog;
use Illuminate\Http\Request;

class SystemLogController extends SystemController
{
    protected $controller_event_text = "系统日志";


    public function index(Request $request){
        $res = (new SystemLog())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }
}
