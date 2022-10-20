<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistryRequest;

class AuthController extends Controller
{
    //******   Sanctum API METHOD       ******/

    // public function register(RegistryRequest $request){
    //     dd($request->name);
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email =  $request->email;
    //     $password = Hash::make($request->password);
    //     $user->password = $password;
    //     $user->save();

    //     $token = $user->createToken('remember_token')->plainTextToken;

    //     return response()->json([
    //         'message' => 'User Register Successfully',
    //         'token' => $token,
    //          200
    //     ]);
    // }

    // public function logout(){

    //     auth()->user()->tokens()->delete();

    //     return response([
    //         'message' => 'Logout Successfuly.'
    //     ]);
    // }

    //******   JWT API METHOD       ******/

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    // public function register(RegistryRequest $request)
    // {
    //     // dd($request->name);
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email =  $request->email;
    //     $password = Hash::make($request->password);
    //     $user->password = $password;
    //     $user->save();
    //     return response()->json([
    //         'message' => 'User Register Successfully',
    //         'user' => $user,
    //         201
    //     ]);
    // }

    // public function login(LoginRequest $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if ($token = Auth::attempt($credentials)) {
    //         return $this->CreateNewToken($token);
    //     } else {
    //         return response([
    //             'message' => 'wrong password or email',
    //             401
    //         ]);
    //     }
    // }

    // public function CreateNewToken($token)
    // {
    //     return response()->json([
    //         'message' => 'Login Success',
    //         'token' => $token,
    //         'type_token' => 'bearer token',
    //         'expires_in' => Auth::factory()->getTTL() * 60,
    //         'user' => Auth::user()
    //     ]);
    // }
    public function home()
    {
        return response([Auth::user()]);
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     return response([
    //         'message' => 'Logout Successfuly.'
    //     ]);
    // }


    //******   PASSPORT API METHOD       ******/

    public function register(RegistryRequest $request)
    {
        // dd($request->name);
        $user = new User;
        $user->name = $request->name;
        $user->email =  $request->email;
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->save();

        $responseArray = [];
        $responseArray['token'] = $user->createToken('my_token')->accessToken;;
        $responseArray['name'] = $user->name;

        return response()->json([
            'message' => 'User Register Successfully',
            $responseArray,
            200
        ]);
    }

    public function login(LoginRequest $request)
    {

        // dd($request->email);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response([
                'message' => 'wrong password or email',
                401
            ]);
        }
        else{
        if (Hash::check($request->password, $user->password)) {
                $success['token'] = $user->createToken('my_token')->accessToken;
            return response([
                'message' => 'Login Success',
                'token' => $success,
                200
            ]);
        } else {

            return response([
                'message' => 'wrong password or email',
                401
            ]);
        }
    }
}

    public function logout(Request $request)
    {
        Auth::user()->token()->revoke(); 

        return response([
            'message' => 'Logout Successfuly.'
        ]);
    }

//     $tokens =  $user->tokens->pluck('id');
// Token::whereIn('id', $tokens)
//     ->update(['revoked'=> true]);

// RefreshToken::whereIn('access_token_id', $tokens)->update(['revoked' => true]);

}
