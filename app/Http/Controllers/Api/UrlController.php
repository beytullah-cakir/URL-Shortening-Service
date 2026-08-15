<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function store(Request $request)
    {

        $validation = $request->validate([
            "original_url" => [
                "required",
                "url",
                "max:2048"
            ]
        ]);

        $url = Url::create([
            'original_url' => $validation["original_url"],
            "user_id" => auth()->id(),
            "is_active" => true
        ]);


        $url->short_code = UrlShortenerService::encode($url->id);
        $url->save();

        return response()->json([
            "message" => "Url saved successfully",
            "original_url" => $url->original_url,
            "short_code" => $url->short_code,
        ]);
    }

    public function index()
    {
        return response()->json([
            "message" => "url brough succesfully",
            "urls" => auth()->user()->urls()->get()
        ]);
    }

    public function show(Url $url)
    {
        $this->authorize('view', $url);

        $url->load("click_logs");

        return response()->json([
            "message" => "url broud succesfully",
            "url" => $url
        ]);
    }


    public function update(Request $request, Url $url)
    {
        $validation = $request->validate([
            "original_url" => [
                "required",
                "max:2048",
                "url"
            ],
            "is_active" => [
                "boolean",
            ]

        ]);

        $this->authorize("update", $url);


        $url->update([
            "original_url" => $validation["original_url"],
            "is_active" => $validation["is_active"] ?? $url->is_active
        ]);

        return response()->json([
            "message" => "url broud succesfully",
            "original_url" => $url->original_url,
        ]);
    }


    public  function delete(Url $url)
    {
        $this->authorize('delete', $url);

        $url->delete();

        return response()->json([
            "message" => "url broud succesfully"
        ]);
    }

    public function analytics(Url $url)
    {
        $this->authorize('view', $url);

        $click_logs = $url->click_logs()->orderBy('visited_at', 'desc')->get();

        return response()->json([
            "message"       => "Analytics retrieved successfully",
            "short_code"    => $url->short_code,
            "original_url"  => $url->original_url,
            "click_logs"    => $click_logs,
        ]);
    }
}
