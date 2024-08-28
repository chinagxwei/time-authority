<?php

namespace App\Http\Controllers\System\Business;

use App\Http\Controllers\SystemController;
use App\Models\Wechat\MiniProgramAccount;
use Illuminate\Http\Request;

class WechatMiniProgramAccountController extends SystemController
{
    protected $controller_event_text = "微信小程序会员管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new MiniProgramAccount())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = MiniProgramAccount::findOneByID($id)) {
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
            if ($model = MiniProgramAccount::findOneByID($id)) {
                $this->deleteEvent($model->nickname);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
