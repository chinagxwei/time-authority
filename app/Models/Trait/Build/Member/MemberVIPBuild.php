<?php

namespace App\Models\Trait\Build\Member;

/**
 * @property int vip_id
 * @property int started_at
 * @property int ended_at
 */
trait MemberVIPBuild
{
    public function setVipId($vip_id)
    {
        $this->vip_id = $vip_id;
        return $this;
    }
    public function setStartedAt($started_at)
    {
        $this->started_at = $started_at;
        return $this;
    }

    public function setEndedAt($ended_at)
    {
        $this->ended_at = $ended_at;
        return $this;
    }
}
