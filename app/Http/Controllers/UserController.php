<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // public function login(LoginRequest $request)
    // {

    //     // dd($request->email);
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {

    //         $token = Auth::user()->createToken('remember_token')->plainTextToken;
    //         return response([
    //             'message' => 'Login Success',
    //             'token' => $token,
    //             200
    //         ]);
    //     } else {

    //         return response([
    //             'message' => 'wrong password or email',
    //             401
    //         ]);
    //     }
    // }

    // public function home()
    // {
    //     return response([Auth::user()]);
    // }
}
