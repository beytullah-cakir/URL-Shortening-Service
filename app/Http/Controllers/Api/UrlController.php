<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
   public function saveURL(Request $request){

       $url=Url::create([
           'original_url'=>$request->input('original_url'),
           "user_id"=>auth()->id(),
           "is_active"=>1
       ]);


       $url->short_code=UrlShortenerService::encode($url->id);
       $url->save();

       return response()->json([
           "message"=>"Url saved successfully",
           "original_url"=>$url->original_url,
           "short_code"=>$url->short_code,
       ]);

   }

   public function index()
   {
       return response()->json([
           "message"=>"url brough succesfully",
           "urls"=>\auth()->user()->urls()->get()
       ]);

   }


   public  function deleteURL()
   {

   }
}
