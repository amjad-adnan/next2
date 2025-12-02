<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\support\Auth;

class AuthControler extends Controller
{
    //Register Api (name, email, password, confirm_password)
    public function register(Request $request){
       
       $data = $request->validate([
            "name" =>"required|string",
            "email"=>"required|email|unique:users,email",
            "password"=>"required"
        ]);

        user::crate($date);

        return response()->json([
            "status" => true,
            "message" =>"user registered successfully"
        ]);
    }

    //login API ( email, password )
    public function login($request){

        $request->validate([
            "email" => "required|email",
            "password" =>"required"
        ]);

        if(!Auth::attempt($request->only("email","password"))){

            return response()->json([
                "status" =>false,
                "message" => "invalid Credentials" 
            ]);
        }

        $user =Auth::user();

       $token = $user->createToken("myToken")->plainTextToken;

       return response()->json([
         "status" =>true,
         "message"=> "user logged in",
         "token"=> $token
       ]);
 }

    //profile API
    public function profile(){

        $user =Auth::user();

        return response()->json([
            "status" =>true,
            "message" =>"user profile data",
            "user"=> $user
        ]);

    }

    //logout API
    public function logout(){
        
        Auth::logout();

        return response()->json([
            "status" =>true,
            "message" => "User logged out successfully"
        ]);
    }
}
