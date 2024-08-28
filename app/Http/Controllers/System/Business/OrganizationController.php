<?php

namespace App\Http\Controllers\System\Business;

use App\Http\Controllers\SystemController;
use App\Models\Organization\Organization;
use Illuminate\Http\Request;

class OrganizationController extends SystemController
{
    protected $controller_event_text = "组织管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new Organization())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = Organization::findOneByID($id)) {
                return $this->successResponse($model);
            }
        }

        return $this->failResponse();
    }

    public function save(Request $request){
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'name' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = Organization::findOneByID($id);

                }else{
                    $model = new Organization();
                }
                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->name);
                    return $this->successResponse();
                }
                return $this->failResponse();
            }catch (\Exception $e){
                return $this->failResponse($e->getMessage());
            }
        }
    }

    public function delete(Request $request){
        if ($id = $request->input('id')) {
            if ($model = Organization::findOneByID($id)) {
                $this->deleteEvent($model->name);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }
}
