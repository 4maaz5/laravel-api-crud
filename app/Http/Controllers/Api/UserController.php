<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function insert(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => ['required', 'email', 'unique:students,email'],
            'password' => 'required'
        ]);
        if ($validated) {
            $save = new Student();
            $save->fname = $request->input('fname');
            $save->lname = $request->input('lname');
            $save->email = $request->input('email');
            $save->password = $request->input('password');
            $save->save();
            return response()->json(['message' => 'Data entered successfully']);
        } else {
            return response()->json(['message' => 'Something wrong!']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $student = Student::all();
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        $student->fname = $request->input('fname');
        $student->lname = $request->input('lname');
        $student->email = $request->input('email');
        $student->password = $request->input('password');
        $student->save();
        return response()->json(['Data updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::destroy($id);
        return response()->json('Data deleted Successfully');
    }
    public function search($id)
    {
        $student = Student::where('email', $id)->get();
        return response()->json($student);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'User deleted successfully!',
        ]);
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if(!$user)
        return response([
           'message'=>'login credentials are invalid!'
        ], 401);
        $token=$user->createToken('mytoken')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ], 201);
    }
}
