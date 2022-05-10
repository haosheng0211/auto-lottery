<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Models\Staff;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Http;
use Throwable;

class StaffPingJob extends Task
{
    public $model;

    public function __construct(Staff $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        try {
            $request = Http::send('POST', '/api_m/get/300002', [
                'base_uri' => config('lottery.staff.base_uri'),
                'headers'  => [
                    'Authorization' => $this->model->access_token,
                ],
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }
        } catch (Throwable $e) {
            if (in_array($e->getCode(), ErrorCode::Unauthorized)) {
                $this->model->update(['status' => StatusCode::Pending]);
            }
        }
    }
}
