<?php

namespace App\Services;

interface CaptchaServiceInterface
{
    public function tries(int $tries): CaptchaServiceInterface;

    public function normal(string $image, int $length = 6, bool $only_number = false): string;
}
