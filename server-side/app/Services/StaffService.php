<?php

namespace App\Services;

use App\Enums\StatusCode;
use App\Models\Staff;

class StaffService implements StaffServiceInterface
{
    public function all()
    {
        $staffs = Staff::query();

        return $staffs->get();
    }

    public function login(int $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->status = StatusCode::Pending;
        $staff->save();
    }

    public function create(string $username, string $password)
    {
        Staff::create([
            'username' => $username,
            'password' => $password,
            'status'   => StatusCode::Stopped,
        ]);
    }

    public function disable(int $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->status = StatusCode::Stopped;
        $staff->stop_message = null;
        $staff->save();
    }

    public function changePassword(int $id, string $password)
    {
        $staff = Staff::findOrFail($id);
        $staff->password = $password;
        $staff->status = StatusCode::Stopped;
        $staff->stop_message = null;
        $staff->save();
    }

    public function selectOptions(StatusCode $status = null)
    {
        $staffs = Staff::query()->select(['id', 'username']);

        if (! is_null($status)) {
            $staffs->where('status', $status->value);
        }

        return Staff::query()->select(['id', 'username'])->get();
    }
}
