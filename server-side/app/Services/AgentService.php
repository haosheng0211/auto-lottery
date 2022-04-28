<?php

namespace App\Services;

use App\Enums\StatusCode;
use App\Models\Agent;

class AgentService implements AgentServiceInterface
{
    public function all()
    {
        $agents = Agent::query()->withCount(['members']);

        return $agents->get();
    }

    public function login(int $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = StatusCode::Pending;
        $agent->save();
    }

    public function create(string $username, string $password)
    {
        Agent::create([
            'username' => $username,
            'password' => $password,
            'status'   => StatusCode::Stopped,
        ]);
    }

    public function disable(int $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = StatusCode::Stopped;
        $agent->stop_message = null;
        $agent->save();
    }

    public function changePassword(int $id, string $password)
    {
        $agent = Agent::findOrFail($id);
        $agent->password = $password;
        $agent->status = StatusCode::Stopped;
        $agent->stop_message = null;
        $agent->save();
    }
}
