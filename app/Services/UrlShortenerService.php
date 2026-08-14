<?php

namespace App\Services;

use function Laravel\Prompts\number;

class UrlShortenerService
{
    // Base62 Karakter Seti (0-9, a-z, A-Z)
    private const CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function encode(int $id): string
    {
        $base = strlen(self::CHARS);
        $code = '';

        while ($id > 0) {
            $code = self::CHARS[$id % $base] . $code;
            $id = (int)($id / $base);
        }

        // Kısa kod uzunluğunu minimum 6 karaktere tamamlamak için başına '0' doldurur
        return str_pad($code, 6, '0', STR_PAD_LEFT);
    }

    public function decode(string $code): int
    {
        $base = strlen(self::CHARS);

        $number=0;

        for ($i = 0; $i < strlen($code); $i++) {
            $number = $number * $base + strpos(self::CHARS, $code[$i]);
        }
        return $number;
    }
}
