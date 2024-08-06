<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string router_name
 * @property string router
 */
trait SystemRouterBuild
{
    public function setRouterName($router_name){
        $this->router_name = $router_name;
        return $this;
    }

    public function setRouter($router){
        $this->router = $router;
        return $this;
    }
}
