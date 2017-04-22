<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;

class UserController extends Controller
{
        /**
         * Registro de nuevo usuario
         */

        public function register(RegisterRequest $request) {
            $new = new User;
            $new->name = $request->name;
            $new->email = $request->email;
            $new->password = bcrypt($request->password);
            $new->save();
            return response()->json(['success'=>true, 'msg'=>'Usuario creado exitosamente'], 200);
        }//end


        //Login a user
        public function login(LoginRequest $request) {
            //dd($request);
            $credentials = $request->only('email', 'password');
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            return response()->json(compact('token'), 200);
        }//end
}
