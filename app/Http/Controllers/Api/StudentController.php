<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Hash;

class StudentController extends Controller
{
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed'
    //     ]);
    //     $user = new User();
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->password = $request->input('password');
    //     $user->save();
    //     $token = $user->createToken('mytoken')->plainTextToken;
    //     return response([
    //         'user' => $user,
    //         'token' => $token
    //     ]);
    // }
}
