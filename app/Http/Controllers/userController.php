<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class userController extends Controller
{
    public function detail(Request $request) {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();
        return $user;  

 }
 public function modifier(Request $request) {
    $user = User::find($request->user_id);
    $user->update($request->all());
    return $user;  

}
public function acceuil(Request $request)
{
    $token = $request->header('Authorization');

    if (!$token) {
        return response()->json(['error' => 'Token not provided'], 401);
    }

    $token = str_replace('Bearer ', '', $token);
    $user = User::where('api_token', $token)->first();
    $role = $user->role->name;

    return response()->json(['user' => $user,
                            'role' => $role], 200);    }



}
