<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Models\Agent;
use App\Models\Staff;
use App\Services\CaptchaServiceInterface;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Http;

class LoginJob extends Task
{
    /**
     * @var Agent|Staff
     */
    private $model;

    /**
     * @var CaptchaServiceInterface
     */
    private $captcha_service;

    public function __construct($model)
    {
        $this->model = $model;
        $this->captcha_service = app(CaptchaServiceInterface::class);
    }

    public function handle()
    {
        try {
            $captcha = $this->getCaptcha();
            $request = Http::send('POST', $this->getAccessTokenUrl(), [
                'base_uri'    => $this->getBaseUrl(),
                'form_params' => [
                    'username' => $this->model->username,
                    'pwd'      => $this->model->password,
                    'key'      => $captcha['key'],
                    'vc'       => $captcha['code'],
                ],
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }

            $this->model->update(['status' => StatusCode::Running, 'access_token' => $content['data']['token']]);
        } catch (Exception $e) {
            if ($e->getCode() === ErrorCode::CaptchaError) {
                $this->handle();

                return;
            }

            $this->model->update(['status' => StatusCode::Stopped, 'stop_message' => $e->getMessage()]);
        }
    }

    private function getBaseUrl(): string
    {
        return $this->model instanceof Agent ? config('lottery.agent.base_uri') : config('lottery.staff.base_uri');
    }

    private function getCaptchaUrl(): string
    {
        return $this->model instanceof Agent ? '/api_e/pub/130001' : '/api_m/pub/330001';
    }

    private function getAccessTokenUrl(): string
    {
        return $this->model instanceof Agent ? '/api_e/pub/130101' : '/api_m/pub/330002';
    }

    private function getCaptcha(): array
    {
        $request = Http::send('POST', $this->getCaptchaUrl(), [
            'base_uri' => $this->getBaseUrl(),
        ]);
        $content = $request->json();

        if ($content['err_code'] !== ErrorCode::Success) {
            throw new Exception($content['err_msg'], $content['err_code']);
        }

        return [
            'key'  => $content['data']['key'],
            'code' => $this->captcha_service->normal($content['data']['img'], 4, true),
        ];
    }
}
