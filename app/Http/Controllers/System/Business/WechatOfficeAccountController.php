<?php

namespace App\Http\Controllers\System\Business;

use App\Http\Controllers\SystemController;
use App\Models\Wechat\OfficeAccount;
use Illuminate\Http\Request;

class WechatOfficeAccountController extends SystemController
{
    protected $controller_event_text = "微信公众号会员管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new OfficeAccount())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = OfficeAccount::findOneByID($id)) {
                return $this->successResponse($model);
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
            if ($model = OfficeAccount::findOneByID($id)) {
                $this->deleteEvent($model->nickname);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
