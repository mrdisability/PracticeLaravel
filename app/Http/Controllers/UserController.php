<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;

use \App\Models\User;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }
    
    public function show($id) {
        return User::find($id);
    }
    
    public function store(Request $request) {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => \Illuminate\Support\Facades\Hash::make($request->input('password'))
        ]);
                
        return response($user, Response::HTTP_CREATED);
    }
    
    public function update() {
        return User::all();
    }
    
    public function destroy() {
        return User::all();
    }
}
