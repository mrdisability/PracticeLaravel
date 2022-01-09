<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        if (\Illuminate\Support\Facades\Auth::attempt($request->only('email', 'password'))) {
            $user = \Illuminate\Support\Facades\Auth::user();
            
            $token = $user->createToken('admin')->accessToken;
            
            return [
                'token' => $token
            ];
        }
        
        return response([
            'error' => 'Invalid Credentials',
            \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED
        ]);
    }
    
    public function register(\App\Http\Requests\RegisterRequest $request) {
        $user = \App\Models\User::create($request->only('first_name', 'last_name', 'email') + [
            'password' => \Illuminate\Support\Facades\Hash::make($request->input('password'))
        ]);
                
        return response($user, \Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
    }
}
