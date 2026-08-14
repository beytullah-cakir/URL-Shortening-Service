<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
   public function store(Request $request){

       $validation = $request->validate([
           "url" => [
               "required",
               "url",
               "max:2048"
           ]
       ]);

       $url=Url::create([
           'original_url'=>$validation["original_url"],
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

   public function show(int $id)
   {
       $url=Url::where("id",$id)->where("user_id",auth()->id())->firstOrFail();

       return response()->json([
           "message"=>"url broud succesfully",
           "url"=>$url
       ]);
   }


   public function update(Request $request, int $id){
       $validation = $request->validate([
           "original_url" => [
               "required",
               "max:2048",
                "url"
           ],
           "is_active" => [
               "integer",
           ]

       ]);

       $url=Url::where("id",$id)->where("user_id",auth()->id())->firstOrFail();

       $url->update([
           "original_url"=>$validation["original_url"],
           "is_active"=>$validation["is_active"]
       ]);

       return response()->json([
           "message"=>"url broud succesfully",
           "original_url"=>$url->original_url,
       ]);



   }


   public  function delete(int $id)
   {
        $url=Url::where("id",$id)->where("user_id",\auth()->id())->firstOrFail();

        $url->delete();

        return response()->json([
           "message"=>"url broud succesfully"
        ]);
   }
}
