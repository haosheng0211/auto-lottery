<?php

namespace App\Services;

use App\Enums\StatusCode;

interface StaffServiceInterface
{
    public function all();

    public function login(int $id);

    public function create(string $username, string $password);

    public function disable(int $id);

    public function changePassword(int $id, string $password);

    public function selectOptions(StatusCode $status = null);
}
