<?php

namespace App\Services;

interface AgentServiceInterface
{
    public function all();

    public function login(int $id);

    public function create(string $username, string $password);

    public function disable(int $id);

    public function changePassword(int $id, string $password);
}
