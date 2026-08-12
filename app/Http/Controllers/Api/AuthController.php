<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {

        $user = User::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Kullanıcı başarıyla oluşturuldu.',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {

        $user = User::where("email", $request->email)->first();




        if (! $user || Hash::check($request->password, $user->password)) {
            throw ValidationException();
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Kullanıcı başarıyla giriş yaptı',
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 200);
    }

    public function logout(Request $request): JsonResponse{

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=> 'kullanıcı çıkış yaptı']);

    }
}
