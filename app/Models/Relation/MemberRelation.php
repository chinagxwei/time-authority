<?php

namespace App\Models\Relation;

use App\Models\Member\Member;

/**
 * @property int member_id
 * @property Member member
 */
trait MemberRelation
{
    public function setMemberID($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }
}
