<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemNavigation;
use Illuminate\Http\Request;

class SystemNavigationController extends SystemController
{
    protected $controller_event_text = "系统菜单";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemNavigation())->searchBuild($request->all())->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id', 0);
            try {
                $this->validate($request, [
                    'navigation_name' => 'required|min:3',
                ]);

                if ($id > 0) {
                    $model = SystemNavigation::findOneByID($id);
                } else {
                    $model = new SystemNavigation();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->navigation_name);
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
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemNavigation::findOneByID($id)) {
                $this->deleteEvent($model->navigation_name);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function sortChange(Request $request)
    {
        $param = $request->all();
        if (is_array($param)) {
            foreach ($param as $value) {
                if ($model = SystemNavigation::findOneByID($value['id'])) {
                    $model->setNavigationSort($value['sort'])->save();
                }
            }
            $this->generateEvent("修改导航排序", "修改导航排序");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenuByParent(Request $request)
    {
        $param = $request->all();
        if ($param['parent_id']) {
            $menus = SystemNavigation::findOneByParent($param['parent_id'], [SystemNavigation::DEFAULT_WITH_CHILDREN_FIELD]);
            return $this->successResponse($menus);
        }

        return $this->failResponse();
    }

    public function registeredMenu()
    {
        $menus = SystemNavigation::query()
            ->select(['id', 'parent_id', 'navigation_name', 'navigation_link', 'menu_show', 'icon', 'navigation_sort'])
            ->whereNull('parent_id')
            ->with([SystemNavigation::DEFAULT_WITH_CHILDREN_FIELD])
            ->get();

        return $this->successResponse($menus);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allMenu(Request $request)
    {
        $user = auth('api')->user();
        $admin = $user->admin;
        return $this->successResponse($admin->role->navigations);
    }
}
