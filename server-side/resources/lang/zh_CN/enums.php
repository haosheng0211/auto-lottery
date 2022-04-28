<?php

use App\Enums\StatusCode;

return [
    StatusCode::class => [
        StatusCode::Stopped => '已停止',
        StatusCode::Pending => '处理中',
        StatusCode::Running => '运行中',
        StatusCode::Success => '已完成',
    ],
];
