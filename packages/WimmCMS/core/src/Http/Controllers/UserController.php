<?php

namespace WimmCMS\core\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request) {
        $user = User::find($request->id);

        
    }

    public function user() {
        if (!Auth::guest()) {
            // $user = User::find(1);
            // $user->admin = true;
            // $user->save();
            return response()->json(['data' => [
                'statusCode' => '200',
                'user' => Auth::user(),
            ]]);
        } else {
            return response()->json([
                'data' => [
                    'statusCode' => '401',
                    'message' => 'You need to be authenticated to access this information.'
                ]
            ]);
        }
    }

    public function userDatesReadable() {
        if (!Auth::guest()) {
            return response()->json(['data' => [
                'statusCode' => '200',
                'user' => [
                    'updated_at' => Auth::user()->updated_at->diffForHumans(),
                    'created_at' => Auth::user()->created_at->diffForHumans(),
                ],
            ]]);
        } else {
            return response()->json([
                'data' => [
                    'statusCode' => '401',
                    'message' => 'You need to be authenticated to access this information.'
                ]
            ]);
        }
    }

    public function getAllUsers() {
        return response()->json(['data' => [
            'statusCode' => '200',
            'users' => User::all(),
        ]]);
    }
}
