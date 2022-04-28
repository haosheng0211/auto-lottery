<?php

use App\Enums\StatusCode;

return [
    StatusCode::class => [
        StatusCode::Stopped => '已停止',
        StatusCode::Pending => '處理中',
        StatusCode::Running => '運行中',
        StatusCode::Success => '已完成',
    ],
];
