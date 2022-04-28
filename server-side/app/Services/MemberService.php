<?php

namespace App\Services;

use App\Models\Member;

class MemberService implements MemberServiceInterface
{
    public function all()
    {
        $members = Member::query()->with(['agent']);

        return $members->get();
    }

    public function selectOptions()
    {
        $members = Member::query()->select(['id', 'username']);

        return $members->get();
    }
}
