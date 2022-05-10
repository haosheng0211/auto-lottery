<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Http\Resources\Remote\MemberResource;
use App\Models\Agent;
use App\Models\Member;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Http;
use Throwable;

class UpdateMemberJob extends Task
{
    public $model;

    public function __construct(Agent $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        try {
            $request = Http::send('POST', '/api_e/page/120103', [
                'base_uri' => config('lottery.agent.base_uri'),
                'headers'  => [
                    'Authorization' => $this->model->access_token,
                ],
                'body'     => 'pageInfo=0*1000',
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }

            foreach (MemberResource::collection($content['data']['list'])->resolve() as $item) {
                if (! Member::find($item['id'])) {
                    $item['agent_id'] = $this->model->id;
                    Member::create($item);
                }
            }
        } catch (Throwable $e) {
            if (in_array($e->getCode(), ErrorCode::Unauthorized)) {
                $this->model->update(['status' => StatusCode::Pending]);
            }
        }
    }
}
