<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agent\ChangePasswordRequest;
use App\Http\Requests\Agent\CreateRequest;
use App\Http\Resources\AgentResource;
use App\Services\AgentServiceInterface;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public $agent_service;

    public function __construct(AgentServiceInterface $agent_service)
    {
        $this->agent_service = $agent_service;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        return AgentResource::collection($this->agent_service->all())->resolve();
    }

    public function login(int $id)
    {
        $this->agent_service->login($id);

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $this->agent_service->create($request->get('username'), $request->get('password'));

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function disable(int $id)
    {
        $this->agent_service->disable($id);

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function changePassword(int $id, ChangePasswordRequest $request)
    {
        $this->agent_service->changePassword($id, $request->get('password'));

        return response()->json([
            'message' => __('Success'),
        ]);
    }
}
