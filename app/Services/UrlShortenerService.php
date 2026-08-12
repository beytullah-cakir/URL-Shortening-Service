<?php

namespace App\Services;

class UrlShortenerService
{
    // Base62 Karakter Seti (0-9, a-z, A-Z)
    private const string CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function encode(int $id): string
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
}
