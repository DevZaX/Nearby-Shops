<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
                "email"=> 'required|email|max:255|unique:users',
                'password' => 'required',
                'confirmed_password'=>'required '
        ]);
        if($validator->fails()){
            return Response::json(["error"=>true,'message'=>$validator->messages()],400);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return "you are registred successfuly";
    	
    }

  public function auth(Request $request){

       if(Session::get("Auth") != null){
            return "ok";
        }else{
            return "no";
        }
        
  }

  public function check(Request $request){

       $email = $request->email;
        $password = $request->password;

        $validator = Validator::make($request->all(),[
            "email"=> 'required',
            'password' => 'required'
    ]);
    if($validator->fails()){
        return Response::json(["error"=>true,'message'=>'champs requireds'],400);
    }

    if(!Auth::attempt(["email"=>$email,"password"=>$password])){
        return Response::json(["error"=>true,'message'=>'incorrect data!'],400);
    }
       Session::put("Auth",Auth::user());
        return  Session::get("Auth");
  }
}
