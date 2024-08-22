<?php

namespace App\Http\Controllers;

use App\Models\System\SystemNavigation;
use App\Models\System\SystemRouter;
use App\Models\User;
use App\Services\User\LoginService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends SystemController
{
    protected $controller_event_text = "认证";

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $param = $request->all();
        $loginService = new LoginService();
        try {
            if (empty($param['type'])) {
                $token = $loginService->setUsername($param['username'])->setPassword($param['password'])->defaultLogin();
                return $this->respondWithToken($token);
            } else if ($param['type'] === 1) {
                // 手机
//                if (empty($param['mobile']) || $param['code']) {
//                    return $this->failResponse('手机登录参数错误');
//                }
//
//                if ($token = $loginService->setMobile($param['mobile'])->setCode($param['code'])->loginByMobile()) {
//                    return $this->respondWithToken($token);
//                } else {
//                    return $this->failResponse('登录失败');
//                }

            } else if ($param['type'] === 2) {
                // 微信

            }
            return $this->failResponse();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->failResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $param = $request->all();
        if ($request->isMethod("POST")) {
            $registerService = new RegisterService();
            DB::beginTransaction();
            try {
                if (empty($param['type']) || $param['type'] === 1) {
                    $this->validate($request,
                        [
                            'username' => 'required|min:5',
                            'password' => 'required|min:6',
                            'mobile' => 'required|min:11',
                            'validate_code' => 'required|min:6',
                        ],
                        [
                            'username' => '用户名长度大于5',
                            'password' => '密码长度大于6',
                            'mobile' => '手机号长度大于11',
                            'validate_code' => '验证码长度大于6'
                        ]
                    );
//                    if (Member::checkRegister($param['mobile'], $param['username'])) {
//                        return self::failResponse('用户已存在');
//                    }
//                    if ($code = Cache::get(SmsService::REGISTER . "_mobile_{$param['mobile']}")) {
//                        if ("$code" === "{$param['validate_code']}") {
//                            $registerService->setPromotionSN($param['pro'] ?? null)
//                                ->setMobile($param['mobile'])
//                                ->setUsername($param['username'])
//                                ->setPassword($param['password'])
//                                ->generateMember();
//                            DB::commit();
//                            Cache::forget(SmsService::REGISTER . "_mobile_{$param['mobile']}");
////                            $this->saveEvent("注册账号");
//                            return self::successJsonResponse();
//                        }
//                        return self::failResponse('验证码校验失败');
//                    }
                    return $this->failResponse('验证码失效');
                }
//                else if ($param['type'] === 2) {
//
//                }
                else {
                    DB::rollBack();
                    return $this->failResponse();
                }

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return $this->failResponse($e->getMessage());
            }

        }

        return $this->failResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request)
    {
        if ($request->isMethod("POST")) {
            DB::beginTransaction();
            try {
                $this->validate($request, [
                    'oldPassword' => 'required',
                    'newPassword' => 'required',
                ]);
                $user = auth('api')->user();
                if (auth('api')->validate([
                    'username' => $user->username,
                    'password' => $request->post('oldPassword')
                ])) {
                    $user->resetPassword($request->post('newPassword'));
                    DB::commit();
                    $this->saveEvent("修改密码");
                    return $this->successResponse();
                }
                return $this->failResponse("旧密码错误");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return $this->failResponse($e->getMessage());
            }
        }
        return $this->failResponse("请求错误");
    }

//    /**
//     * Get the authenticated User.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function info()
//    {
//        /** @var User $user */
//        $user = auth('api')->user();
//
//        if ($user && ($user->isSuperManager() || $user->isManager() || $user->isEnterpriseManager())) {
//            $navigation_str = Cache::get(SystemNavigation::USER_NAVIGATION_KEY . "_{$user->id}");
//            $info = $user->admin->toArray();
//            $info['navigations'] = json_decode($navigation_str) ?? [];
//            return self::successResponse($info);
//        }
//        return self::failResponse('Not Found');
//    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->saveEvent("登出");
        auth('api')->logout();

        return $this->successResponse();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        /** @var User $user */
        $user = auth('api')->user();

        $this->saveEvent("登录");

        $result_array = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => time() + auth('api')->factory()->getTTL() * 60
        ];

        if ($user->role->isManager()) {
            if ($user->role->isSuperAdmin()) {
                $navigations = SystemNavigation::getParentAll([SystemNavigation::DEFAULT_WITH_CHILDREN_FIELD]);
            } else {
                $navigations = $user->role->navigations;
            }
            Cache::put(SystemNavigation::USER_NAVIGATION_KEY . "_{$user->id}", json_encode($navigations->toArray()));
        }

        if (!$user->role->isManager()) {
            $routers = $user->role->routers;
            $routers_array = $routers->map(function ($v) {
                return $v->router;
            });
            Cache::put(SystemRouter::USER_ROUTER_KEY . "_{$user->id}", json_encode($routers_array));
        }

        return $this->successResponse($result_array);
    }
}
