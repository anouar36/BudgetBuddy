<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{
    public function login(Request $request){

        if(!Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return response()->json([
                "success"=>false,
                "status"=>200,
            ]);
        }
        
        $user = auth()->user();
        $token = $user->createToken('token');
        return $token->plainTextToken;



    }
}
