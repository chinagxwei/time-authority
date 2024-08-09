<?php

namespace App\Models\Trait\Build\Member;

/**
 * @property string wallet_id
 * @property int role_id
 * @property string organization_id
 * @property int order_revenue_config_id
 * @property string nickname
 * @property string mobile
 * @property string avatar
 * @property string remark
 * @property int develop
 * @property int promotion_sn
 * @property int node_level
 * @property string parent_id
 * @property string belong_agent_node
 * @property int register_type
 */
trait MemberBuild
{

    public function setOrganizationID($organization_id){
        $this->organization_id = $organization_id;
        return $this;
    }

    public function setOrderRevenueConfigID($order_revenue_config_id){
        $this->order_revenue_config_id = $order_revenue_config_id;
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

    public function setAvatar($avatar){
        $this->avatar = $avatar;
        return $this;
    }

    public function setRemark($remark){
        $this->remark = $remark;
        return $this;
    }

    public function setDevelop($develop){
        $this->develop = $develop;
        return $this;
    }

    public function setPromotionSn($promotion_sn){
        $this->promotion_sn = $promotion_sn;
        return $this;
    }

    public function setNodeLevel($node_level){
        $this->node_level = $node_level;
        return $this;
    }

    public function setParentId($parent_id){
        $this->parent_id = $parent_id;
        return $this;
    }

    public function setBelongAgentNode($belong_agent_node){
        $this->belong_agent_node = $belong_agent_node;
        return $this;
    }

    public function setRegisterType($register_type){
        $this->register_type = $register_type;
        return $this;
    }

    public function setRoleID($role_id){
        $this->role_id = $role_id;
        return $this;
    }
}
