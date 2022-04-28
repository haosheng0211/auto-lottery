<?php

namespace App\Providers;

use App\Services\AgentService;
use App\Services\AgentServiceInterface;
use App\Services\CaptchaService;
use App\Services\CaptchaServiceInterface;
use App\Services\MemberService;
use App\Services\MemberServiceInterface;
use App\Services\StaffService;
use App\Services\StaffServiceInterface;
use App\Services\StrategyService;
use App\Services\StrategyServiceInterface;
use App\Services\TrackService;
use App\Services\TrackServiceInterface;
use App\Services\WagerService;
use App\Services\WagerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AgentServiceInterface::class, AgentService::class);
        $this->app->bind(CaptchaServiceInterface::class, CaptchaService::class);
        $this->app->bind(StaffServiceInterface::class, StaffService::class);
        $this->app->bind(MemberServiceInterface::class, MemberService::class);
        $this->app->bind(StrategyServiceInterface::class, StrategyService::class);
        $this->app->bind(WagerServiceInterface::class, WagerService::class);
        $this->app->bind(TrackServiceInterface::class, TrackService::class);
    }

    public function boot()
    {
    }
}
