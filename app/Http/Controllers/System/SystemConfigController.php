<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemConfig;
use Illuminate\Http\Request;

class SystemConfigController extends SystemController
{
    protected $controller_event_text = "系统配置";


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new SystemConfig())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request){
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'key' => 'required|min:1',
                    'value' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = SystemConfig::findOneByID($id);
                } else {
                    $model = new SystemConfig();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->key);
                    return $this->successResponse();
                }
            } catch (\Exception $e) {
                return $this->failResponse($e->getMessage());
            }
        }
        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemConfig::findOneByID($id)) {
                $this->deleteEvent($model->key);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
