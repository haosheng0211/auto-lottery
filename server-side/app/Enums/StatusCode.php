<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Stopped()
 * @method static static Pending()
 * @method static static Running()
 * @method static static Success()
 */
final class StatusCode extends Enum implements LocalizedEnum
{
    public const Stopped = 0;

    public const Pending = 1;

    public const Running = 2;

    public const Success = 3;
}
