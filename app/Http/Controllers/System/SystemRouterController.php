<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemRouter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SystemRouterController extends SystemController
{
    protected $controller_event_text = "系统路由";


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemRouter())->searchBuild($request->all())->paginate();
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
                    'router_name' => 'required|min:3',
                    'router' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = SystemRouter::findOneByID($id);
                } else {
                    $model = new SystemRouter();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->router_name);
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
            if ($model = SystemRouter::findOneByID($id)) {
                $this->deleteEvent($model->router_name);
                $model->delete();
                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function registeredRouter()
    {
        $res = SystemRouter::query()->select(['id','router_name', 'router'])->get();
        return $this->successResponse($res);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function systemRouter()
    {

        /** @var User $user */
        $user = auth('api')->user();

        if ($user && $user->role->isSuperAdmin()) {

            $routes = Route::getRoutes();

            foreach ($routes as $k => $value) {
                $route_path[$k]['uri'] = $value->uri;
                $methods = join('|', $value->methods);
                $route_path[$k]['method'] = ($methods == 'GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS' ? 'ANY' : $methods);
            }

            return $this->successResponse($route_path);
        }

        return $this->failResponse('权限不足');
    }
}
