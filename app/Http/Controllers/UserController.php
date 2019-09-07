<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credintals = $request->only('email','password');

        try {
            if(! $token = JWTAuth::attempt($credintals)){
                return response()->json(['error'=>'invalid_credintals'],401);
            }
        } catch (JWTException $e) {
            return response()->json(['error'=>'could_not_create_token'],500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'],404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['token_expired'],$e->getStatusCode());
        }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return response()->json(['token_invalid'],$e->getStatusCode());
        }catch(Tymon\JWTAuth\Exceptions\JWTException $e){
                return response()->json(['token_absent'],$e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:225',
            'email'=>'required|string|email|max:225|unique:users',
            'password'=>'required|string|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'membership_id'=>1
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }
}
