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
        $validatedData=$request->validate([
            'name'=>[
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'email'=>[
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',

            ],
            'password'=>[
                'required',
                'confirmed',
                'min:8',

            ]
        ]);


        $user = User::create([
            "name"     =>$validatedData['name'],
            "email"    => $validatedData['email'],
            "password" => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token,
            "message" => "Register successfully"
        ]);

    }

    public function login(Request $request)
    {

        $validatedData=$request->validate([
            'email'=>[
                'required',
                'string',
                'email',
                'max:255',
                'exists:users,email',
            ],
            'password'=>[
                'required',
                'min:8',

            ]
        ]);

        $user = User::where("email", $validatedData["email"])->first();


        if (!Hash::check($validatedData["password"], $user->password))  throw ValidationException::withMessages(["password" => "Password is not correct"]);






        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Login successfully',
        ]);
    }

    public function logout(Request $request): JsonResponse{

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=> 'kullanıcı çıkış yaptı']);

    }


    public function me()
    {
        return response()->json(auth()->user());
    }
}
