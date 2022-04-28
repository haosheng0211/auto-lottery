<?php

use App\Enums\StatusCode;

return [
    StatusCode::class => [
        StatusCode::Stopped => 'Stopped',
        StatusCode::Pending => 'Pending',
        StatusCode::Running => 'Running',
        StatusCode::Success => 'Success',
    ],
];
