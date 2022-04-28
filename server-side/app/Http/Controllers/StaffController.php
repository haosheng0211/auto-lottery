<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staff\ChangePasswordRequest;
use App\Http\Requests\Staff\CreateRequest;
use App\Http\Resources\StaffResource;
use App\Services\StaffServiceInterface;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public $staff_service;

    public function __construct(StaffServiceInterface $staff_service)
    {
        $this->staff_service = $staff_service;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        return StaffResource::collection($this->staff_service->all())->resolve();
    }

    public function login(int $id)
    {
        $this->staff_service->login($id);

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $this->staff_service->create($request->get('username'), $request->get('password'));

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function disable(int $id)
    {
        $this->staff_service->disable($id);

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function changePassword(int $id, ChangePasswordRequest $request)
    {
        $this->staff_service->changePassword($id, $request->get('password'));

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function selectOptions()
    {
        return $this->staff_service->selectOptions();
    }
}
