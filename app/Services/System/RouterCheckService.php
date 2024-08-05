<?php

namespace App\Services\System;

use Illuminate\Support\Facades\Log;

class RouterCheckService
{
    /** @var array */
    private $allowedRoute = [];

    /**
     * @param $allowedRoutes
     * @return $this
     */
    public function setAllowedRoutes($allowedRoutes)
    {
        $this->allowedRoutes = $allowedRoutes;
        return $this;
    }

    /**
     * @param $path
     * @return bool
     */
    public function can($path)
    {
        if (empty($path) || empty($this->allowedRoutes) || count($this->allowedRoutes) <= 0) {
            return false;
        }

        if (in_array($path, $this->allowedRoutes)) {
            return true;
        }

        foreach ($this->allowedRoutes as $allowedRoute) {
//            Log::info($path);
//            Log::info($allowedRoute);
            if ($this->matchRoute($allowedRoute, $path)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $allowedRoute
     * @param $path
     * @return false|int
     */
    private function matchRoute($allowedRoute, $path)
    {
        $allowedRoute = str_replace('*', '.*', $allowedRoute); // 将*转换为正则表达式的任意字符匹配
        $allowedRoute = str_replace('/', '\/', $allowedRoute); // 将/转义，避免正则表达式中的冲突
        $pattern = '/^' . $allowedRoute . '$/';
//        Log::info($pattern);
        return preg_match($pattern, $path);
    }
}
