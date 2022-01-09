<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;

use \App\Models\User;

class UserController extends Controller
{
    public function index() {
        //Instead of fetching all users
//        return User::all();
        
        //return User::paginate();
        
        //foreign key to get role
        //return User::with('role')->paginate();
        
        $users = User::paginate();
        
        return \App\Http\Resources\UserResource::collection($users);
    }
    
    public function show($id) {
        //return User::find($id);
        
        //foreign key to get role
        //return User::with('role')->find($id);
        
        $user = User::find($id);
        
        return new \App\Http\Resources\UserResource($user);
    }
    
    public function store(\App\Http\Requests\UserCreateRequest $request) {
        $user = User::create($request->only('first_name', 'last_name', 'email', 'role_id') + [
            'password' => \Illuminate\Support\Facades\Hash::make(1234)
        ]);
                
        return response($user, Response::HTTP_CREATED);
    }
    
    public function update(\App\Http\Requests\UserUpdateRequest $request, $id) {
        $user = User::find($id);
        
        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'));
        
        return response($user, Response::HTTP_ACCEPTED);
    }
    
    public function destroy($id) {
        User::destroy($id);
        
        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    public function user() {
        return \Auth::user();
    }
    
    public function updateInfo(\App\Http\Requests\UpdateInfoRequest $request) {
        $user = \Auth::user();
        
        $user->update($request->only('first_name', 'last_name', 'email'));
        
        return response($user, Response::HTTP_ACCEPTED);
    }
    
    public function updatePassword(\App\Http\Requests\UpdatePasswordRequest $request) {
        $user = \Auth::user();
        
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->input('password'))
        ]);
        
        return response($user, Response::HTTP_ACCEPTED);
    }
}

//Pull then merge then push up new commit

//$ is for variables in php, laravel

//$user->update([
//    'first_name' => $request->input('first_name'),
//    'last_name' => $request->input('last_name'),
//    'email' => $request->input('email'),
//    'password' => \Illuminate\Support\Facades\Hash::make($request->input('password'))
//]);

//$user = User::create([
//    'first_name' => $request->input('first_name'),
//    'last_name' => $request->input('last_name'),
//    'email' => $request->input('email'),
//    'password' => \Illuminate\Support\Facades\Hash::make(1234)
//]);