<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string action_name
 * @property string action_description
 * @property string ip
 */
trait SystemLogBuild{

    public function setActionName($action_name){
        $this->action_name = $action_name;
        return $this;
    }

    public function setActionDescription($action_description){
        $this->action_description = $action_description;
        return $this;
    }

    public function setIP($ip){
        $this->ip = $ip;
        return $this;
    }
}
