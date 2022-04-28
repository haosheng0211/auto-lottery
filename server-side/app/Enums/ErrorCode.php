<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Success()
 * @method static static CaptchaError()
 * @method static static Unauthorized()
 */
final class ErrorCode extends Enum
{
    public const Success = 0;

    public const CaptchaError = 300001;

    public const Unauthorized = [200000, 200001, 200002, 200003];
}
