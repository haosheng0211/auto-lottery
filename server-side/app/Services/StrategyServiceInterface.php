<?php

namespace App\Services;

interface StrategyServiceInterface
{
    public function all();

    public function create(int $staff_id, int $member_id, int $min_limit, int $max_limit, float $tariff);

    public function exists(int $staff_id, int $member_id): bool;

    public function update(int $id, array $attributes);
}
