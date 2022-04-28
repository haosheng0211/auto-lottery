<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class CaptchaService implements CaptchaServiceInterface
{
    private int $tries = 3;

    public function tries(int $tries): CaptchaServiceInterface
    {
        $this->tries = $tries;

        return $this;
    }

    public function normal(string $image, int $length = 6, bool $only_number = false): string
    {
        --$this->tries;
        $request = Http::send('POST', '/ocr/b64/json', [
            'base_uri' => config('captcha.base_uri'),
            'body'     => $image,
        ]);
        $content = $request->json();

        if ($content['msg'] || strlen($content['result']) != $length || $only_number !== is_numeric($content['result'])) {
            if ($this->tries > 0) {
                return $this->normal($image, $length, $only_number);
            }

            throw new Exception($content['msg']);
        }

        return $content['result'];
    }
}
