<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('passeord'))
        ]);
        return response()->json([
            'data'=>'ok'
        ],201);
    }
}
