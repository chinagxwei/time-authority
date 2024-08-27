<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\SystemController;
use App\Models\System\SystemAdmin;
use App\Models\System\SystemNavigation;
use App\Models\User;
use App\Services\User\SystemAdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SystemAdminController extends SystemController
{
    protected $controller_event_text = "平台管理员";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemAdmin())->searchBuild($request->all(), ['creator', 'role'])->paginate();
        return $this->successResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');
            $param = $request->all();
            if ($id <= 0) {
                $this->validate($request, [
                    'username' => 'required|min:6',
                    'password' => 'required|min:6',
                    'role_id' => 'required',
                ]);
//                $model = new User();
//
//                $model->registerManager($request->all());
//
//                $admin = new SystemAdmin();

                $service = new SystemAdminService();

                $model = $service->setUsername($param['username'])
                    ->setPassword($param['password'])
                    ->setRoleId($param['role_id'])
                    ->setRemark($param['remark'] ?? '')
                    ->register();
//
//                $admin->setMobile($param['mobile'])
//                    ->setAdminRole($param['role_id'])
//                    ->setNickname($model->username);
//
//                if (!empty($param['remark'])) {
//                    $admin->setRemark($param['remark']);
//                }
//
//                $model->admin()->save($admin);

                $this->saveEvent($model->username ?? '');

            } else {
                $admin = SystemAdmin::findOneByID($id);

                $admin->setMobile($param['mobile'])
                    ->setNickname($param['nickname'])
                    ->setAdminRole($param['role_id'])
                    ->save();
            }
            return $this->successResponse();
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

            if ($admin = SystemAdmin::findOneByID($id)) {

                if ($admin->user->isSuperManager()) {
                    return $this->failResponse();
                }

                $this->deleteEvent($admin->nickname);

                $admin->user()->delete();

                $admin->delete();

                return $this->successResponse();
            }
        }

        return $this->failResponse();
    }

    public function info()
    {
        /** @var User $user */
        $user = auth('api')->user();

        if ($user && ($user->role->isSuperAdmin() || $user->role->isManager())) {
            $navigation_str = Cache::get(SystemNavigation::USER_NAVIGATION_KEY . "_{$user->id}");
            $info = $user->admin->toArray();
            $info['navigations'] = json_decode($navigation_str) ?? [];
            return $this->successResponse($info);
        }
        return $this->failResponse('Not Found');
    }
}
