<?php

namespace App\Http\Controllers\System\Business;

use App\Http\Controllers\SystemController;
use App\Models\Withdrawal\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends SystemController
{
    protected $controller_event_text = "提款管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new Withdrawal())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = Withdrawal::findOneByID($id)) {
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
            if ($model = Withdrawal::findOneByID($id)) {
                $this->deleteEvent($model->id);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
