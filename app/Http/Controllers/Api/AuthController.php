<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    public function register(Request $request){
        $input = [
            "name" =>$request->name,
            "password"=> Hash::make($request->password),
            "email" => $request->email
        ];
        $user = User::create($input);
        //User adalah modelyang dipanggil dari file User.php
        return response()->json([
            "status" => "success",
            "message" => "Registrasi berhasil"
        ]);
    }
    public function login(Request $request){
        $input = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        $user = User::where("email", $input["email"])->first();
        if(Auth::attempt($input)){
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                "code" => 200,
                "status" => "success",
                "message" => "Login berhasil",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "code" => 401,
                "status" => "error",
                "message" => "login failed",
            ]);
        }
    }
}
