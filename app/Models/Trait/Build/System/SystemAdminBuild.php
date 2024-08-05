<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string $remark
 * @property string $nickname
 * @property string $mobile
 * @property int $role_id
 */
trait SystemAdminBuild{

    public function setRemark($remark){
        $this->remark = $remark;
        return $this;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;
        return $this;
    }

    public function setMobile($mobile){
        $this->mobile = $mobile;
        return $this;
    }

}
