<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;

class UrlRedirectController extends Controller
{
    public function redirect(string $short_code)
    {
        $url=Url::where("short_code",$short_code)->where("is_active",1)->firstOrFail();

        return redirect()->away($url->original_url);
    }
}
