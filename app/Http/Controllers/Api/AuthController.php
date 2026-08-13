<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $user = User::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;


        return redirect()->route("dashboard")->with(["token" => $token]);
    }

    public function login(Request $request)
    {

        $user = User::where("email", $request->email)->first();

        if(!$user) throw ValidationException::withMessages(["email" => "Email doesn't exist"]);
        if (!Hash::check($request->password, $user->password))  throw ValidationException::withMessages(["password" => "Password is not correct"]);



        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route("dashboard");
    }

    public function logout(Request $request): JsonResponse{

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=> 'kullanıcı çıkış yaptı']);

    }
}
