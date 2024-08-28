<?php

namespace App\Http\Middleware;

use App\Models\System\SystemRouter;
use App\Models\User;
use App\Services\System\RouterCheckService;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class SystemAuthenticate extends Middleware
{

    /**
     * @param $request
     * @param Closure $next
     * @param ...$guards
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {

        if (!$this->auth->guard('api')->check()) {
            return response()->json(['code' => 403, 'message' => '请先登录']);
        }

        $path = "/" . $request->path();

        /** @var User $user */
        if ($user = auth('api')->user()) {

            if ($user->role->isSuperAdmin()) {
                return $next($request);
            } else {

//                Log::info(explode('/', $path));

                $routes_str = Cache::get(SystemRouter::USER_ROUTER_KEY . "_{$user->id}");

                $allow_routes = json_decode($routes_str) ?? [];

//                Log::info($allow_routes);

                /** @var RouterCheckService $service */
                $service = app(RouterCheckService::class);

                $res = $service->setAllowedRoutes($allow_routes)->can($path);

//                Log::info("type:" . ($res ? '1' : '0'));

                if (!$res) {
                    return response()->json(['code' => 403, 'message' => '没有访问内容的权限']);
                }
            }
        }


//
//        /** @var RouterCheckService $service */
//        $service =  app(RouterCheckService::class);
//
//        $res = $service->setAllowedRoutes([
////            '/api/v1/auth/info',
//        ])->can($path);
//
//        Log::info("type:" . ($res ? '1' : '0'));

        return $next($request);
    }
}
