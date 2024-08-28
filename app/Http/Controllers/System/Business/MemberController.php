<?php

namespace App\Http\Controllers\System\Business;

use App\Http\Controllers\SystemController;
use App\Models\Member\Member;
use Illuminate\Http\Request;

class MemberController extends SystemController
{
    protected $controller_event_text = "会员管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new Member())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = Member::findOneByID($id)) {
                return $this->successResponse($model);
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function save(Request $request){
//        if ($request->isMethod('POST')) {
//            $id = $request->input('id');
//
//            try {
//                $this->validate($request, [
//                    'title' => 'required|min:1',
//                    'content' => 'required|min:1',
//                    'type' => 'required|min:1',
//                    'status' => 'required|min:1',
//                ]);
//
//                if ($id > 0) {
//                    $model = Area::findOneByID($id);
//                } else {
//                    $model = new Area();
//                }
//
//                if ($model->fill($request->all())->save()) {
//                    $this->saveEvent($model->title);
//                    return $this->successResponse();
//                }
//            } catch (\Exception $e) {
//                return $this->failResponse($e->getMessage());
//            }
//        }
//        return $this->failResponse();
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        if ($id = $request->input('id')) {
            if ($model = Member::findOneByID($id)) {
                $this->deleteEvent($model->nickname);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
