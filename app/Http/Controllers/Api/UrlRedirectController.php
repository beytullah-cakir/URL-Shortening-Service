<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClickLog;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlRedirectController extends Controller
{
    public function redirect(string $short_code, Request $request)
    {
        $url=Url::where("short_code",$short_code)->where("is_active",1)->firstOrFail();

        $url->increment('click_count');

        ClickLog::create([
            "url_id" => $url->id,
            "ip_address" => request()->ip(),
            "user_agent" => request()->userAgent(),
            "referer" => request()->headers->get('referer'),
            "visited_at" => now(),
        ]);

        return redirect()->away($url->original_url);
    }
}
