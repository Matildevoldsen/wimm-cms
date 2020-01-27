<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if (!$validator) {
            return response([
                'errors' => [
                    'root' => [$validator]
                ]
            ], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        if ($user = User::create($input)) {
            $token = $user->createToken('wimm')->accessToken;

            return response()->json([
                'data' => $user,
                'meta' => [
                    'token' => $token
                ]
            ], 200);
        } else {
            return response([
                'errors' => [
                    'root' => 'There was an error in creating your user.'
                ]
            ], 422);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validate) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('wimm')->accessToken;

                return response()->json([
                    'data' => $user,
                    'meta' => [
                        'token' => $token
                    ]
                ], 200);
            } else {
                return response([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
                ], 422);
            }
        } else {
            return response([
                'errors' => [
                    'root' => $validate
                ]
            ], 422);
        }
    }

    public function logout()
    {
        if (!Auth::guest()) {
            $user = Auth::user()->token();
            $user->revoke();
            Cookie::forget('_token');

            return response()->json([
                'data' => [
                    'statusCode' => 200,
                    'message' => 'Successfully logged out'
                ]
            ]);
        }
    }
}
