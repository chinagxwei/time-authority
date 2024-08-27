<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemMessage;
use Illuminate\Http\Request;

class SystemMessageController extends SystemController
{
    protected $controller_event_text = "系统消息";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new SystemMessage())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemMessage::findOneByID($id)) {
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
                    $model = SystemMessage::findOneByID($id);
                } else {
                    $model = new SystemMessage();
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
            if ($model = SystemMessage::findOneByID($id)) {
                $this->deleteEvent($model->title);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request){
        if ($id = $request->input('id')) {
//            SystemMessageService::send($id);
            return $this->successResponse();
        }

        return $this->failResponse();
    }
}
