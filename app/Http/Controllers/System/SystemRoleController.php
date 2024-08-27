<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemRole;
use Illuminate\Http\Request;

class SystemRoleController extends SystemController
{
    protected $controller_event_text = "系统角色";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemRole())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id, ['navigations', 'routers'])) {
                return $this->successResponse($model);
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'role_name' => 'required|min:2',
                ]);

                if ($id > 0) {
                    $model = SystemRole::findOneByID($id);
                } else {
                    $model = new SystemRole();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->role_name);
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
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                $this->deleteEvent($model->role_name);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    public function setNavigation(Request $request){
        if ($id = $request->input('id')) {
            $navigation_ids = $request->input('navigation_ids');
            if ($model = SystemRole::findOneByID($id)) {
                $model->navigations()->sync($navigation_ids);
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    public function setRouter(Request $request){
        if ($id = $request->input('id')) {
            $router_ids = $request->input('router_ids');
            if ($model = SystemRole::findOneByID($id)) {
                $model->routers()->sync($router_ids);
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRouterByRole(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                return $this->successResponse($model->routers);
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNavigationByRole(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                return $this->successResponse($model->navigations);
            }
        }

        return $this->failResponse();
    }
}
