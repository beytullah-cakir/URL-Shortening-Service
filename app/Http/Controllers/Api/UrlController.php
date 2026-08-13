<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
   public function store(Request $request, UrlShortenerService $urlShortenerService){

       $url=Url::create([
           'original_url'=>$request->input('original_url'),
           "user_id"=>auth()->id(),
           "is_active"=>1
       ]);


       $url->short_code=$urlShortenerService->encode($url->id);
       $url->save();

       return redirect()->route("dashboard");

   }
}
