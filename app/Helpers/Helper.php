<?php

namespace App\Helpers;

use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Support\Str;

class Helper
{

    public static function generateToken()
    {
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        return hash_hmac('sha256', Str::random(40), $key);
    }
}