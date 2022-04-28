<?php

namespace App\Services;

use App\Models\Strategy;

class StrategyService implements StrategyServiceInterface
{
    public function all()
    {
        $strategies = Strategy::query()->with(['staff', 'member']);

        return $strategies->get();
    }

    public function create(int $staff_id, int $member_id, int $min_limit, int $max_limit, float $tariff)
    {
        Strategy::create([
            'staff_id'  => $staff_id,
            'member_id' => $member_id,
            'min_limit' => $min_limit,
            'max_limit' => $max_limit,
            'tariff'    => $tariff,
            'active'    => false,
        ]);
    }

    public function exists(int $staff_id, int $member_id): bool
    {
        return Strategy::query()->whereStaffId($staff_id)->whereMemberId($member_id)->exists();
    }

    public function update(int $id, array $attributes)
    {
        $strategy = Strategy::findOrFail($id);
        $strategy->update($attributes);
    }
}
