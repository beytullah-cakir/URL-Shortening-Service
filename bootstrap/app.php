<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {


        //422 Unprocessable Entity
        $exceptions->render(function (
            ValidationException  $e,
            $request,
        ){
            if($request->expectsJson()){
                return response()->json([
                   "success" => false,
                   "message"=>  "Validation kurallarını karsilamıyorsun",
                    "errors"  => $e->errors(),
                ],422);
            }
        });

        //404 Not Found
        $exceptions->render(function (
            NotFoundHttpException $e,
            $request,
        ){
            if($request->expectsJson()){
                return response()->json([
                    "success" => false,
                    "message"=>  "Sayfa Bulunamadı",
                ],404);
            }
        });

        //401 Unauthorized
        $exceptions->render(function (UnauthorizedException $e , Request $request) {
            if($request->expectsJson()){
                return response()->json([
                    "success" => false,
                    "message"=>"Kimlik Dogrulaması Gerekli",
                ],401);
            }
        });

        //403 Forbidden
        $exceptions->render(function (AuthorizationException $e , Request $request) {
            if($request->expectsJson()){
                return response()->json([
                    "success" => false,
                    "message"=>"Kullanıcı kimligi dogrulandı ancak kaynaga erisim izniniz yok",
                ],403);
            }
        });

        //500 Internal Error
        $exceptions->render(function (Throwable $e ,Request $request) {
            if($request->expectsJson()){
                return response()->json([
                    "success" => false,
                    "message"=>"Beklenmedik hata oluştu",
                ],500);
            }
        });
    })->create();
