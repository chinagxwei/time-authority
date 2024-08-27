<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemAgreement;
use Illuminate\Http\Request;

class SystemAgreementController extends SystemController
{
    protected $controller_event_text = "系统协议";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new SystemAgreement())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = SystemAgreement::findOneByID($id)) {
                return $this->successResponse($model);
            }
        }

        return $this->failResponse();
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
                    'title' => 'required|min:1',
                    'content' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = SystemAgreement::findOneByID($id);
                } else {
                    $model = new SystemAgreement();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->title);
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
            if ($model = SystemAgreement::findOneByID($id)) {
                $this->deleteEvent($model->title);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
